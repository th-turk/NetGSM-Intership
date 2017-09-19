<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 31.7.2017
 * Time: 21:33
 */
// src/AppBundle/DataFixtures/ORM/LoadUserData.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__."/fixtures.yml",
            $manager,[
                "providers"=>[$this]
            ]
            );
    }
    public function department()
    {
        $genera =[
            "Accounts DepartmentForm",
            "Electronic Data Processing",
            "Purchasing DepartmentForm",
            "Export Sales DepartmentForm",
            "Administrative Accounting",
            "Management",
            "IT DepartmentForm",
            "Marketing",
            "CEO",
            "Service Engineer",
            "Secretary",
            "Economist",
            "Assistant"
        ];

        $key=array_rand($genera);
        return $genera[$key];
    }

    public function degree()
    {
        $genera =[
            "Chief Executive Officer(CEO)",
            "President",
            "Senior Director",
            "Director",
            "Manager",
            "Employee",
        ];

        $key=array_rand($genera);
        return $genera[$key];
    }

}