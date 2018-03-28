<?

namespace App\Components;

abstract class AbstractComponent
{
    private $dir;
    protected $params = [];

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    protected function getHtml()
    {
        extract($this->params);
        require $this->dir.'/View.php';
    }

    protected function getStyle()
    {
        require $this->dir.'/Style.css';
    }

    protected function getScripts()
    {
        require $this->dir.'/Scripts.js';
    }

}
