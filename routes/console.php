<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('retrieve-comics')->everyFifteenMinutes()->name('Retrieve comics');
