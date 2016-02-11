<?php
namespace Rock\Api\Controller;


use RockEinstein\Lib\Api\Controller\AbstractController;

class Welcome extends AbstractController {


    public function get($name, $lastname = null) {
        return array("Message" => "Welcome " . $name . " " . $lastname);
    }

    /**
     * @param $response
     * @param bool|true $manyRegisters
     */
    public function filter($response, $manyRegisters = true) {

        if ($manyRegisters) {
            foreach ($response as $idx => $res) {
                foreach ($this->removeFields as $key) {
                    unset($response[$idx][$key]);
                }
            }
        } else {
            foreach ($this->removeFields as $key) {
                unset($response[$key]);
            }
        }


        return $response;
    }
}