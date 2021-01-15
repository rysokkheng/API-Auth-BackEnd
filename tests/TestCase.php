<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function request()
    {
        return $this
            ->withHeaders([
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNWUxZTdmZGU5YTFhMWExMThiYjg0MDQ3M2E3NmI0YTI5ODFiZjJkYTljZDM2ZTE3YTU4OGM5OGZiOWU3ODFkYzI2Njk2MDczNjg5MGZjYjciLCJpYXQiOjE2MDgxMDM5NDUsIm5iZiI6MTYwODEwMzk0NSwiZXhwIjoxNjM5NjM5OTQ1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.lOeVEWpJNrZbhRpdcAeDuEkjOhLX86xNG1p_PVqZMUwz2j3Mi_SaUrsqqex0u9KzmXaSJvOWSpVNoxdJCMUKQHsWMSmoHMRywkPuLSjgXJgV6aQgGTkSGfI2cbsG8MOp5SIW4IEi-0ChcpmASo-KEwxu6bzmFqv90E0-BWCKrWuTas_JPCYJtYQXo_drmCbigB6FeVNQsWe_rKpKxVzsUlnJp1lBD7ESUoolOqT6RCGD4q3ME1EsYClHfdj-3wJ73JGbAll9rS_5dgEIoW7fCW2Tf7e3oCBqoaA7uvsTQkT2pv-jsQAXQow70zVjwSFI_LIk6NrGM85-SBtuThMjFDjmc9jq_OfkIEO6LyHbRmOqyDaNVUnpZelIprBu7kIRiOoS1im8OOIQa33FyecfQBeJR1mlSdRWF0t5bEYp9fjRg2Xb_45R0yj-0yzsyXyDK3KPaV7p8FpIs4KebsXCZ0H7HtcEvQxOONiEw_eveG09WtnhZGYOHc7vu90q0hlsLWZ6aNNmTucHBA_j65RJMC-xfP52J5-O5VYajE1SYilWhpifN1ulhQWL4i-WrlaJIYhxyiwJ6vzrkT1BXjaFHtifH47RRdl0-TauZ6UrxnnXNFHunzyXeIa4SKR4lEEdmQ8tXh0D0XdFF5le_TdmV50ZiUPEAPyCaTcOTs_V5R8',
            ]);
    }
}
