<?php

namespace App\Http\Conversations;

use App\Models\Course;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class SearchingCoursesCoversations extends Conversation {

    public function run(): void {

        $this->ask('¿Que curso te gustaria saber?', function($answer){
            $this->say('Buscando cursos de '. $answer->getText(). '...');

            $this->askCursos( $answer->getText());
        });

    }

    protected function askCursos($lenguaje)
    {

        $cursos = Course::where('lenguaje', 'like', '%' . $lenguaje . '%')->get();

        if ($cursos->isEmpty()) {

            $this->say('Lo siento no se encontro el curso de ' . $lenguaje);
            $this->stopsConversation(new IncomingMessage('Lo siento no se encontro el curso de ' . $lenguaje, '', 'botman'));

        } else {

            $this->say('Se ha encontrado ' . $cursos->count(). ' de ' . $lenguaje .':');

            $this->getItems($cursos);
            //$this->cursosImg($cursos);
        }


    }

    protected function getItems($cursos){
        $cursos->each(function(Course $course){
            $this->say('Nombre: '. $course->nombre);
        });
    }

    // metodo para capturar una imagen en base de datos
    /* protected function cursosImg($courses) {
        $courses->each(function(Course $course){
            $this->say(
                OutgoingMessage::create()
                    ->withAttachment(
                        new Image('direcciondelcurso'),
                    ),
                );
            $this->say('<a target="_blanck" href="#" >'. 'nombre del enlace'. '</a>');
        });
    } */
}

