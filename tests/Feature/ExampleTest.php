<?php

namespace Tests\Feature;

#regino USE

use Tests\TestCase;

#endregion

final class ExampleTest extends TestCase
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    #endregion
}
