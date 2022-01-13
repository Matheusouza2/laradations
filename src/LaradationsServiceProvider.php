<?php

namespace SertSoft\Laradations;

use Illuminate\Support\ServiceProvider;

class LaradationsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/../config/sertapi.php' => config_path('sertapi.php')]);

        $msg = $this;
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages) use ($msg)
        {
            $messages += $msg->message();
            return new Laradator($translator, $data, $rules, $messages);
        });
    }

    protected function message()
    {
        return [
            'cnh' => 'O campo :attribute não é uma CNH válida.',
            'tituloEleitor' => 'O campo :attribute não é um Titulo de Eleitor válido.',
            'cnpj' => 'O campo :attribute não é um CNPJ válido.',
            'cpf' => 'O campo :attribute não é um CPF válido.',
            'renavam' => 'O campo :attribute não é um Renavam válido.',
            'cpf_cnpj' => 'O campo :attribute não é um CPF ou CNPJ válido.',
            'nis' => 'O campo :attribute não é um NIS válido.',
            'cns' => 'O campo :attribute não é um Cartão do SUS válido.',
            'certidao' => 'O campo :attribute não é uma Certidão válida.',
        ];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}