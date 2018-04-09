<?php

namespace Framework;

use Framework\Components\ResolverComponent;
use Symfony\Component\Yaml\Yaml;
use ReflectionClass;
use Framework\Entities\User;
use Framework\Entities\Component;
use Framework\Database\DB;

use Framework\Services\User as UserService;

class Main
{

    public static function run(): void
    {
        $YML = Yaml::parseFile(__DIR__.'/../config/pages/page.example.yml');
        foreach ($YML['register']['type'] as $value) {
            ResolverComponent::resolve($value);
        }
        try {
            $user = new User(1, 'Cezar Teste up1111 eh nois', 'cezar.teste@gmail.com', '123456', date('Y-m-d H:i:s'));
            $user->update();

            $component = new Component('users');
            $component->id = NULL;
            $component->name = 'Cezar Teste StdClass eh nois';
            $component->email = 'cezar.teste@gmail.com';
            $component->password = '12345600000';
            $component->created_at = date('Y-m-d H:i:s');

            $component->insert();

            // $userService = new UserService();
            // $userService->recoveryPassword();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

}
