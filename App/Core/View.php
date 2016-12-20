<?php


namespace App\Core;

/**
 * Class Base View
 *
 * @package App\Core
 */
class View
{
    /**
     * Rendering layout.
     *
     * @var string
     */
    protected $view = "Views";

    /**
     * Render view file, surrounding it with layout.
     *
     * @param string $viewFile View file name to render.
     * @param array  $params   Render parameters.
     *
     * @return void
     */
    public function render($viewFile, array $params = [])
    {
        ob_start();
        $this->renderPartial($viewFile, $params);
        $content = ob_get_contents();
        ob_clean();

        ob_start();
        require ROOT_PATH . "/App/{$this->view}/{$viewFile}.php";
        $result = ob_get_contents();
        ob_clean();
        echo $result;
    }

    /**
     * Renders view file without wrapping it with layout.
     *
     * @param string $view   View file name to render.
     * @param array  $params View rendering parameters.
     *
     * @return mixed
     */
    public function renderPartial($view, array $params = [])
    {
        $filename = $this->resolveViewFilename($view);
        ob_start();
        extract($params, EXTR_OVERWRITE);
        require $filename;
        $contents = ob_get_contents();
        ob_clean();

        echo $contents;
    }

    /**
     * Returns view filename by it's symbolic name.
     *
     * @param string $view View name.
     *
     * @return string
     */
    protected function resolveViewFilename($view)
    {
       $viewFilepath = implode(DIRECTORY_SEPARATOR, [
            ROOT_PATH,
            'App',
            $this->view,
            "{$view}.php"
        ]);
       return $viewFilepath;
    }
}