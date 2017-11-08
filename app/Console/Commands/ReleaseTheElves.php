<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        // get all people
        // sort by longest list of not allowed people
        // while dont have a list call generate function
            // generate function will
            // have a empty list
            // for each person
            // diff the remaining people with the people they may not match
            // if the remaining list is empty return false (this should cause the loop to call function again
            // if not empty pick a random and add the key/value pair to the list

        $people = collect(config('people'));
        $sortedPeople = $people->sort(function ($personA, $personB) {
            return count($personB['blocked']) <=> count($personA['blocked']);
        })->toArray();

        do {
            $this->matchPeople($sortedPeople);
        } while (empty($this->matchedPeople) === true);

        dd($this->matchedPeople);

        // go through matches and send sms or email
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
