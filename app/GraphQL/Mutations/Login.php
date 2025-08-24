<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use GraphQL\Error\UserError;
use Illuminate\Support\Facades\Hash;
use Nodesol\LaraQL\Attributes\Type;
use Nodesol\LaraQL\Attributes\Mutation;

#[Type(
    columns_override:[
        'token'=>'String!',
        'user'=>"User!",
    ]
)]
#[Mutation(
    name:' ',
    query:'@field(resolver:"Login")',
    inputs:[
        'email'=>'String! @rules(apply:["required","email"])',
        'password'=>'String! @rules(apply:["required"])'
    ]
)]
class Login
{

    public function __invoke($root, array $args)
    {
        // TODO implement the resolver

        $user = User::whereEmail($args['email'])->first();

        if(!$user || !Hash::check($args['password'],$user->password)){
            return new UserError('Invalid credentails ');
        }

        $token = $user->createToken('token')->plainTextToken;
        $data = ['user'=>$user,'token'=>$token];
        return $data;
    }
}
