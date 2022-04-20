<?php
namespace Emc\Tests\Feature;

use Emc\CarriersList;
use Emc\ContentCategory;
use Emc\Country;
use Emc\ListPoints;
use Emc\ParcelPoint;
use Emc\Quotation;
use Emc\Tests\TestCase;

class ApiTest extends TestCase
{
    public function testCarriersList()
    {
        $env = new CarriersList();
        $env->getCarriersList();
        $this->assertFalse($env->resp_error);
        $this->assertIsArray($env->carriers);
        $this->assertNotEmpty($env->carriers);
    }

    public function testContentCategory()
    {
        $env = new ContentCategory();
        $env->getCategories();
        $this->assertFalse($env->resp_error);
        $this->assertIsArray($env->categories);
        $this->assertNotEmpty($env->categories);
    }

    public function testCountry()
    {
        $env = new Country();
        $env->getCountries();
        $this->assertFalse($env->resp_error);
        $this->assertIsArray($env->countries);
        $this->assertNotEmpty($env->countries);
    }

    public function testParcelPoint()
    {
        // test ListPoints
        $env1 = new ListPoints();
        $env1->getListPoints(
            ["MONR"],
            [
                "collecte" => "exp",
                "pays" => "FR",
                "cp" => "88000",
                "ville" => "Epinal",
            ]
        );
        $this->assertFalse($env1->resp_error);
        $this->assertIsArray($env1->list_points[0]["points"]);
        $this->assertNotEmpty($env1->list_points[0]["points"]);
        // test ParcelPoint
        $env = new ParcelPoint();
        $env->getParcelPoint(
            ParcelPoint::PICKUP_POINT,
            $env1->list_points[0]["points"][0]["code"],
            "FR"
        );
        $this->assertFalse($env->resp_error);
        $this->assertIsArray($env->points);
        $this->assertNotEmpty($env->points);
    }

    public function testQuotation()
    {
        $env = new Quotation();
        $env->getQuotation(
            [
                "pays" => "FR",
                "code_postal" => "88000",
                "type" => "entreprise",
                "ville" => "Epinal",
                "adresse" => "2 rue de Nancy",
                "civilite" => "M",
                "prenom" => "John",
                "nom" => "Doe",
                "societe" => "Splitfire",
                "email" => "contact@example.fr",
                "tel" => "°33606060606",
            ],
            [
                "pays" => "FR",
                "code_postal" => "54000",
                "type" => "particulier",
                "ville" => "Nancy",
                "adresse" => "34 Allée Brumaire",
                "civilite" => "M",
                "prenom" => "John",
                "nom" => "Doe",
                "email" => "contact@example.fr",
                "tel" => "°33606060606",
            ],
            [
                "type" => "colis",
                "dimensions" => [
                    [
                        "hauteur" => 100,
                        "largeur" => 100,
                        "longueur" => 100,
                        "poids" => 100,
                    ],
                ],
            ],
            [
                "type_emballage.emballage" => "1-Boîte",
                "code_contenu" => 80200,
                "colis.description" => "RAS",
                "colis.valeur" => 100,
            ]
        );
        $this->assertFalse($env->resp_error);
        $this->assertIsArray($env->offers);
        $this->assertNotEmpty($env->offers);
    }
}
