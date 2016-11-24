<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 24.11.2016
 * Time: 14:20
 */

namespace Test;

trait BaseDataProvidersTrait
{
    /**
     * @return array
     */
    public function roleDataProvider()
    {
        return [
            [
                'admin',
                'permissions' => [
                    'createFP' => true,
                    'deleteFP' => true,
                    'createCategory' => true,
                    'deleteCategory' => true,
                    'userManagement' => true
                ]
            ],
            [
                'employee',
                'permissions' => [
                    'createFP' => true,
                    'deleteFP' => false,
                    'createCategory' => true,
                    'deleteCategory' => false,
                    'userManagement' => false
                ]
            ],
            [
                'guest',
                'permissions' => [
                    'createFP' => false,
                    'deleteFP' => false,
                    'createCategory' => false,
                    'deleteCategory' => false,
                    'userManagement' => false
                ]
            ],
        ];
    }
}
