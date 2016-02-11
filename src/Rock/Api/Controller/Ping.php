<?php
namespace Rock\Api\Controller;


use RockEinstein\Lib\Api\Controller\AbstractController;

class Ping extends AbstractController {


    public function get() {
        return array("Pong");
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