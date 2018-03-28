<?

namespace App\Views;

use App\Components\ResolverComponent;

class Main
{

    static function execute()
    {
        $array = ['input','text'];
        foreach ($array as $value) {
            ResolverComponent::resolve($value);
        }
    }
}
