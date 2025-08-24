<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Nodesol\LaraQL\Attributes\Mutation;
use Nodesol\LaraQL\Attributes\Type;

use function PHPSTORM_META\type;

#[Type(
    columns_override: [
        'token' => 'String',
        'data' => 'User',
    ]
)]
#[Mutation(
    name: ' ',
    query: '@field(resolver:"Register")',
    inputs: [
        'name' => 'String! @rules(apply:["required"])',
        'email' => 'String! @rules(apply:["required","unique:users,email"])',
        'password' => 'String! @rules(apply:["required","confirmed","min:8"])',
        'password_confirmation' => 'String! @rules(apply:["required","min:8"])',
    ]
)]
class Register
{
    /** @param  array{}  $args */
    public function __invoke($root, array $args)
    {
        // TODO implement the resolver
        $user = User::create($args);

        $token = $user->createToken('token')->plainTextToken;

        $data = ['token' => $token, 'data' => $user];

        return $data;

    }
}
