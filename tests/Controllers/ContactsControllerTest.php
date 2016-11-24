<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 24.11.2016
 * Time: 13:53
 */

namespace Test\Controllers;

use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Test\BaseDataProvidersTrait;
use Test\TestCase;

class ContactsControllerTest extends TestCase
{
    use DatabaseTransactions, BaseDataProvidersTrait;

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_create_new_contact($roleName, $permissions)
    {
        $validData = $this->getValidContactData();

        $countContacts = Contact::count();
        $this->dontSeeInDatabase('contacts', [
            'name' => $validData['name']
        ]);

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'POST',
            '/contacts/0/edit',
            $validData
        );

        $countContacts2 = Contact::count();
        if ($permissions['createFP']) {
            $this->assertTrue($countContacts2 == ($countContacts+1));
            $this->seeInDatabase('contacts', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countContacts2 == $countContacts);
            $this->dontSeeInDatabase('contacts', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_update_contact($roleName, $permissions)
    {
        $validData = $this->getValidContactData();

        $contact = factory(Contact::class)->create();

        $countContacts = Contact::count();
        $this->dontSeeInDatabase('contacts', [
            'name' => $validData['name']
        ]);

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'POST',
            '/contacts/'.$contact->id.'/edit',
            $validData
        );

        $countContacts2 = Contact::count();
        if ($permissions['createFP']) {
            $this->assertTrue($countContacts2 == ($countContacts));
            $this->seeInDatabase('contacts', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countContacts2 == $countContacts);
            $this->dontSeeInDatabase('contacts', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_delete_contact($roleName, $permissions)
    {
        $contact = factory(Contact::class)->create();

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'GET',
            '/contacts/'.$contact->id.'/delete'
        );

        if ($permissions['deleteFP']) {
            $this->dontSeeInDatabase('contacts', [
                'name' => $contact->name
            ]);
        } else {
            $this->seeInDatabase('contacts', [
                'name' => $contact->name
            ]);
        }
    }

    protected function getValidContactData()
    {
        return [
            'name' => 'Test Contact Name'
        ];
    }
}
