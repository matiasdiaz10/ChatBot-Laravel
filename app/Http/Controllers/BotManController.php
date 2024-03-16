<?php

namespace App\Http\Controllers;

use App\Http\Conversations\SearchingCoursesCoversations;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    //

    public function handle() {

        /** @var BotMan $botman */
        $botman = app('botman');

        /* $botman->hears('Hola chatbot', function(BotMan $bot){
            $bot->reply('Hola!');

            $bot->ask('Para comenzar ayudarte, contame como es tu nombre?', function(Answer $answer, Conversation $bot){
                $bot->say('Encantado '.$answer->getText(). '!, en que puedo ayudarte?');
            });
        });


        // Mensajes que el bot no entiende
        $botman->fallback(function(BotMan $bot){
            $bot->reply('Lo siento, no entendi tu mensaje..');
        });

        $botman->hears('cursos', function(BotMan $bot){
            $bot->startConversation(new SearchingCoursesCoversations());
        }); */

        $botman->hears('{message}', function(BotMan $bot, string $message){
            match($message){
                'Hola' => $bot->reply('Hola, soy un bot que te ayudara a encontrar los cursos que buscas. Escribe "cursos" para comenzar.'),
                'cursos' => $bot->startConversation(new SearchingCoursesCoversations()),
                default => $bot->reply('Lo siento, no entiendo lo que quieres decir.'),
            };
        });

        $botman->listen();
    }
}
