<?php

namespace App\Job;

use App\Contracts\Queue;
use App\Trait\Queue\Queueable;

class UnfollowJob implements Queue
{
    use Queueable;

    /**
     * @param \stdClass $payload
     */
    public function __construct(public \stdClass $payload)
    {
        # do something
    }

    public function handle(): void
    {
        # acessa o instagram
        if (
            \mail(
                $this->payload->email,
                "Mensageria - teste",
                "Este é apenas um teste de mensageria.\r\nAtt,\r\nAdão Dias",
            )
        ) {
            echo "E-mail enviado com sucesso!";

            return;
        }

        echo "E-mail não foi enviado.";
    }
}
