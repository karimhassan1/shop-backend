<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use GraphQL\Error\UserError;
use Illuminate\Support\Facades\Hash;
use Nodesol\LaraQL\Attributes\Type;
use Nodesol\LaraQL\Attributes\Mutation;

#[Type()]
#[Mutation(
    name: '',
    query: '@field(resolver:"ResetPassword")',
    inputs: [
        'current_password' => 'String! @rules(apply:["required"])',
        'password' => 'String! @rules(apply:["required","confirmed"])',
        'password_confirmation' => 'String! @rules(apply:["required"])',
    ],
    directives: ['@guard']

)]
final readonly class ResetPassword
{
    /** @param  array{}  $args */
    public function __construct(public ?string $message)
    {}
    public function __invoke(null $_, array $args)
    {
        $user = auth()->user();
        $oldPassword = $args['current_password'];

        if (! Hash::check($oldPassword, $user->password)) {
            throw new UserError('current password is wrong');
        }
        $user->update($args);

        return ['message'=>'Password updated'];
    }
}
