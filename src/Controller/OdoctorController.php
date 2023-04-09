<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Patient;
use App\Entity\Service;
use SoapClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OdoctorController extends AbstractController
{   
    public $connectionSoapClient;
    public Patient $patient;
    public $services;

    public function __construct()
    {
        $this->connectionSoapClient = new SoapClient(
            'https://api.gemotest.ru/odoctor.wsdl',
            [
                'login'     => '10003-gem',
                'password'  => 'Sp$8A_L}I',
                'trace'     => true
            ]
        ); 
        $this->patient  = new Patient('Тестовый', 'Пациент', '2015-01-01', 0);
        $this->services = [
            new Service('NM_MF_2&MF', 'Drugoe', 'L_drugoe', '00025'),
        ];
    }

    #[Route('/create-orders/{ext_num}', name: 'createOrder', methods: ['GET', 'HEAD'])]
    public function create(string $ext_num): Response 
    {
        $order = new Order(
            $ext_num, 
            '10003', 
            sha1("{$ext_num}10003Тестовый2015-01-01b4f6d7d2fe94123c03c86412a0b649494017463f"), 
            'Some comment6', 
            $this->services, 
            $this->patient
        );

        dd ($this->connectionSoapClient->create_order($order));            
    }

    #[Route('/update-orders/{ext_num}/{order_num}', name: 'updateOrder', methods:['GET'])]
    public function update(string $ext_num, string $order_num){
        $order = new Order(
            $ext_num, 
            '10003', 
            sha1("{$ext_num}{$order_num}10003Тестовый2015-01-01b4f6d7d2fe94123c03c86412a0b649494017463f"), 
            'Updated comment', 
            $this->services,
            $this->patient,
            $order_num
        );

        dd($this->connectionSoapClient->create_order($order));
    }

    #[Route('/cancel-orders/{ext_num}/{order_num}/{order_status}', name: 'cancelOrder')]
    public function cancel(string $ext_num, string $order_num, int $order_status){
        dd($this->connectionSoapClient->cancel_order(
                [
                    'order_status'  => $order_status,
                    'ext_num'       => $ext_num,
                    'order_num'     => $order_num,
                    'contractor'    => '10003',
                    'hash'          => sha1("{$ext_num}{$order_num}10003b4f6d7d2fe94123c03c86412a0b649494017463f")
                ]
            )); 
    }

    #[Route('/status/{order_num}', name: 'status')]
    public function status(string $order_num){
        dd($this->connectionSoapClient->get_order_status(
            [
                'contractor'    => '10003',
                'orders'        => [$order_num],
                'hash'          => sha1('10003b4f6d7d2fe94123c03c86412a0b649494017463f')
            ]
        ));
    }

    #[Route('/orders/{ext_num}/{order_num}', name: 'getOrder')]
    public function get(string $ext_num, string $order_num){
        dd($this->connectionSoapClient->status_request(
            [
                'ext_num'       => $ext_num,
                'order_num'     => $order_num,
                'contractor'    => '10003',
                'hash'          => sha1("{$ext_num}{$order_num}10003b4f6d7d2fe94123c03c86412a0b649494017463f")
            ]
        )); 
    }
}