<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Nodesol\LaraQL\Attributes\Type;
use Nodesol\LaraQL\Attributes\Mutation;

#[Type(
    columns_override:[
        'message'=>"String!"
    ]
)]
#[Mutation(
    name:' ',
    query:'@field(resolver:"Logout")',
    inputs:[],
    directives:['@guard']
)]
class Logout
{
    /** @param  array{}  $args */
    public function __invoke($root, array $args)
    {
        // TODO implement the resolver

        auth()->user()->currentAccessToken()->delete();
        $data['message'] = 'Logout Successfully';
        return $data;

    }
}
