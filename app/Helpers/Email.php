<?php

namespace App\Helpers;

use Mailjet\Resources;
use vendor\mailjet\src;

use App\Helpers\Menu;

use Illuminate\Support\Facades\Mail;

class Email
{

    public static function send_html_email_devis( $data,$data2)
    {
        $data=(array)$data;
        Mail::send('devismail',  ['data' =>$data,'data2' =>$data2] , function ($message) use ($data) {
            $message->to($data['mail_devis'], 'Client')->bcc('rapideautogroupe@gmail.com','Rapide Auto Groupe')->subject('DEVIS No : '.$data['num_fact']);
            $message->from('acyao@ldfgroupe.com', 'Rapide Auto Groupe');
        });
    }

    public static function get_envoimailTemplate($email, $nom, $messages, $sujet, $titre)
    {

$logo = Menu::get_logo();
        $mj = new \Mailjet\Client('', '', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => " ",
                        'Name' => @$logo->mot_cle
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $nom
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "message" => $messages,
                    ],
                    'TemplateID' => 4485492,
                    'TemplateLanguage' => true,
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }


    public static function get_envoimailReclamationTemplate($nom, $messages, $sujet, $titre, $type)
    {

$logo = Menu::get_logo();
        $mj = new \Mailjet\Client('', '', true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "",
                        'Name' => $nom
                    ],
                    'To' => [
                        [
                            'Email' => "",
                            'Name' => @$logo->mot_cle
                        ]
                    ],
                    'Variables' => [
                        "titre" => $titre,
                        "type" => $type,
                        "message" => $messages,
                    ],
                    'TemplateID' => 1832735,
                    'TemplateLanguage' => true,
                    'Subject' => $sujet,

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        return $response;
    }

}
