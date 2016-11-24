<?php

namespace Test\Controllers;

use App\Http\Controllers\FundingProgrammesController;
use App\Models\Category;
use App\Models\FundingProgramme;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Test\BaseDataProvidersTrait;
use Test\TestCase;

class FundingProgrammesControllerTest extends TestCase
{
    use DatabaseTransactions, BaseDataProvidersTrait;

    public static function tralala(){
        return factory(Category::class)->create();
    }

    /**
     * @return array
     */
    public function filterFundingProgrammesTestData()
    {
        $category1 = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();
        $category3 = factory(Category::class)->create(['parent_id' => $category1->id]);

        $costs1 = 'Test Cost 1';
        $costs2 = 'Test Cost 2';
        $costs3 = 'Test Cost 3';

        $fundingProgramme1 = factory(FundingProgramme::class)->create([
            'category_id' => $category1->id,
            'target_what' => json_encode([$costs1])
        ]);
        $fundingProgramme2 = factory(FundingProgramme::class)->create([
            'category_id' => $category1->id,
            'target_what' => json_encode([$costs1, $costs2])
        ]);
        $fundingProgramme3 = factory(FundingProgramme::class)->create([
            'category_id' => $category2->id,
            'target_what' => json_encode([$costs2, $costs3])
        ]);
        $fundingProgramme4 = factory(FundingProgramme::class)->create([
            'category_id' => $category3->id,
            'target_what' => json_encode([$costs1, $costs3])
        ]);
        $fundingProgramme5 = factory(FundingProgramme::class)->create([
            'category_id' => $category3->id,
            'target_what' => json_encode([$costs3])
        ]);

        return [
            'no_filter' => [
                'filterData' => [
                    // category ids
                    [],
                    // target what
                    []
                ],
                'expectedFundingProgrammeIds' =>[
                    $fundingProgramme1->id,
                    $fundingProgramme2->id,
                    $fundingProgramme3->id,
                    $fundingProgramme4->id,
                    $fundingProgramme5->id
                ]
            ],
            'category_filter_include_childs' => [
                'filterData' => [
                    // category ids
                    [$category1->id],
                    // target what
                    []
                ],
                'expectedFundingProgrammeIds' =>[
                    $fundingProgramme1->id,
                    $fundingProgramme2->id,
                    $fundingProgramme4->id,
                    $fundingProgramme5->id
                ]
            ],
            'category_filter' => [
                'filterData' => [
                    // category ids
                    [$category2->id],
                    // target what
                    []
                ],
                'expectedFundingProgrammeIds' =>[
                    $fundingProgramme3->id
                ]
            ],
            'costs_filter' => [
                'filterData' => [
                    // category ids
                    [],
                    // target what
                    [$costs1]
                ],
                'expectedFundingProgrammeIds' =>[
                    $fundingProgramme1->id,
                    $fundingProgramme2->id,
                    $fundingProgramme4->id
                ]
            ],
            'costs_and_category_filter' => [
                'filterData' => [
                    // category ids
                    [$category2->id, $category3->id],
                    // target what
                    [$costs1, $costs2]
                ],
                'expectedFundingProgrammeIds' =>[
                    $fundingProgramme3->id,
                    $fundingProgramme4->id
                ]
            ]
        ];
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_create_new_funding_programme($roleName, $permissions)
    {
        $validData = $this->getValidFundingProgrammeData();

        $countFP = FundingProgramme::count();
        $this->dontSeeInDatabase('funding_programmes', [
            'name' => $validData['name']
        ]);

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'POST',
            '/funding_programmes/0/edit',
            $validData
        );

        $countFP2 = FundingProgramme::count();
        if ($permissions['createFP']) {
            $this->assertTrue($countFP2 == ($countFP+1));
            $this->seeInDatabase('funding_programmes', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countFP2 == $countFP);
            $this->dontSeeInDatabase('funding_programmes', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_update_funding_programme($roleName, $permissions)
    {
        $validData = $this->getValidFundingProgrammeData();

        $fundingProgramme = factory(FundingProgramme::class)->create();

        $countFP = FundingProgramme::count();
        $this->dontSeeInDatabase('funding_programmes', [
            'name' => $validData['name']
        ]);

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'POST',
            '/funding_programmes/'.$fundingProgramme->id.'/edit',
            $validData
        );

        $countFP2 = FundingProgramme::count();
        if ($permissions['createFP']) {
            $this->assertTrue($countFP2 == ($countFP + 1));
            $this->seeInDatabase('funding_programmes', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countFP2 == $countFP);
            $this->dontSeeInDatabase('funding_programmes', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_delete_funding_programme($roleName, $permissions)
    {
        $fundingProgramme = factory(FundingProgramme::class)->create();

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'GET',
            '/funding_programmes/'.$fundingProgramme->id.'/delete'
        );

        if ($permissions['deleteFP']) {
            $this->dontSeeInDatabase('funding_programmes', [
                'name' => $fundingProgramme->name
            ]);
        } else {
            $this->seeInDatabase('funding_programmes', [
                'name' => $fundingProgramme->name
            ]);
        }
    }

    public function test_get_filtered_funding_programmes()
    {
        foreach ($this->filterFundingProgrammesTestData() as $data) {
            $filterData = $data['filterData'];
            $expectedFundingProgrammeIds = $data['expectedFundingProgrammeIds'];

            $filteredFundingProgrammes = $this->callProtectedMethod(
                new FundingProgrammesController(),
                'getFilteredFundingProgrammes',
                $filterData
            );

            $filteredFundingProgrammeIds = [];
            foreach ($filteredFundingProgrammes as $fundingProgramme) {
                $filteredFundingProgrammeIds[] = $fundingProgramme->id;
            }
            $intersect = array_intersect($expectedFundingProgrammeIds, $filteredFundingProgrammeIds);
            $this->assertTrue(count($filteredFundingProgrammeIds) >= count($intersect));
            sort($expectedFundingProgrammeIds);
            sort($intersect);
            $this->assertEquals($expectedFundingProgrammeIds, $intersect);
        }
    }

    /**
     * @return array
     */
    protected function getValidFundingProgrammeData()
    {
        $validData = [
            'name' => 'Test Funding Programme Creation',
            'organisation' => 'Test Funding Programme Creation Org',
            'category_id' => factory(Category::class)->create()->id
        ];
        return $validData;
    }
}
