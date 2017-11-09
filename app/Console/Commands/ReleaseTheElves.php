<?php

namespace App\Console\Commands;

use App\Mail\SendGifteeName;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReleaseTheElves extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-secrets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out the secret messages to everyone';

    protected $matchedPeople = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $people = collect(config('people'));
        $sortedPeople = $people->sort(function ($personA, $personB) {
            return count($personB['blocked']) <=> count($personA['blocked']);
        })->toArray();

        do {
            $this->matchPeople($sortedPeople);
        } while (empty($this->matchedPeople) === true);

        // go through matches and send sms or email
        foreach ($this->matchedPeople as $sender => $receiver) {
            $senderInfo = $people[$sender];

            if (empty($senderInfo['email']) === false) {
                Mail::to($senderInfo['email'])->send(new SendGifteeName($receiver));
            } elseif (empty($senderInfo['phone']) === false) {
                app('twilio')->message($senderInfo['phone'], sprintf('Hi there, you have been matched with %s for secret santa this year. Happy gift hunting!', $receiver));
            }
        }
    }

    /**
     *
     *
     * @return array
     */
    public function matchPeople($people)
    {
        $matches = [];
        $remainingPeople = array_keys($people);

        foreach ($people as $name => $options) {
            $availableMatches = array_diff($remainingPeople, array_merge($options['blocked'], [$name]));

            if (count($availableMatches) === 0) {
                return false;
            }

            $match = $availableMatches[array_rand($availableMatches)];
            unset($remainingPeople[array_search($match, $remainingPeople)]);
            $matches[$name] = $match;
        }

        $this->matchedPeople = $matches;
    }
}
