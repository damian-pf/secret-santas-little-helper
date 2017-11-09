# Secret Santa's Little Helper

This was built in two 15 minute sessions so is very basic but gets the job done.

The main set up is all in the `config/people.php` file.

Here you add all the people being matched. You are able to set a blocked list for each person. This is handy if you don't want spouses or best friends to be matched.

Everyone must also have a `phone` or `email` so that they can receive there matched person.

*If you wish to send SMS do not add an email address as it will send an email by default*
```php
// Example person
'Prancer'    => [
  'blocked' => [
      'Dancer',
      'Nic',
  ],
  'phone'   => '+64 27 123 4567',
  'email'   => 'Prancer@santas.workshop'
],
```

The only other set up you need to do is add in the credentials to your favourite email sending service and/or details for a Twilio account if you wish to use SMS sending.

Once that is all set up all you need to do is open up your terminal window and type `php artisan i-am-santa` from the project directory.