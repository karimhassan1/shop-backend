<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;
use App\Models\User;
use Nodesol\LaraQL\Attributes\Type;
use Nodesol\LaraQL\Attributes\Mutation;

#[Type(
    columns_override: [
        'token'=>'String',
        'user'=>'User',
        'message'=>'String'
    ]
)]
#[Mutation(
    name: ' ',
    query: '@field(resolver:"Register")',
    inputs: [
        'name'=>'String! @rules(apply:["required"])',
        'phone'=>'String! @rules(apply:["required"])',
        'email'=>'String! @rules(apply:["required","unique:users,email"])',
        'password'=>'String! @rules(apply:["required","confirmed","min:8"])',
        'password_confirmation'=>'String! @rules(apply:["required","min:8"])'
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

        $data = ['token'=>$token,'user'=>$user,'message'=>'Regiser Successfully'];

        return $data;

    }
}
