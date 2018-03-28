<?

namespace App\Components\Textarea;

use App\Components\IComponent;
use App\Components\AbstractComponent;

class Index extends AbstractComponent implements IComponent
{

    public function __construct()
    {
        parent::__construct(__DIR__);
    }

    public function render() {
        $this->params['b'] = 'teste texto';
        $this->getHtml();
    }
}
