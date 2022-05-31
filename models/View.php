<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once 'models/Audit.php';

class View
{

    private $file;
    private $t;
    private $css;
    private $js;
    private $script;

    public function __construct($action)
    {
        $this->file = 'views/'.$action.'.php';
    }

    // Génère une vue (Appelée uniquement si l'utilisateur est connecté), d'abord les composants, puis le contenu, inséré dans une variable
    public function generate($data){
        $audit = new Audit();
        $data['notifs'] = $audit->selectNotifs();

        $content = $this->generateFile($this->file, $data);
        $sideBar = $this->generateFile('views/components/sidebar.php',  $data);
        $topbar = $this->generateFile('views/components/topbar.php',  $data);
        $modals = $this->generateFile('views/components/modals.php',  $data);
        $vue = $this->generateFile('views/base.php', ['title' => $this->t, 'css' => $this->css, 'content' => $content, 'sidebar' => $sideBar, 'topbar' => $topbar, 'modals' => $modals]);

        return $vue;
    }

    // Génère la vue de connexion, différente des autres
    public function generateWithoutTemplate($data){
        $content = $this->generateFile($this->file, $data);
        $vue = $this->generateFile('views/base.php', ['title' => $this->t, 'css' => $this->css, 'content' => $content, 'sidebar' => '', 'topbar' => '']);
        return $vue;
    }

    public function generatePdf($data){

        require_once 'vendor/dompdf/autoload.inc.php';

      $content = $this->generateFile($this->file, $data);
        $sideBar = $this->generateFile('views/components/sidebar.php',  $data);
        $topbar = $this->generateFile('views/components/topbar.php',  $data);
        $modals = $this->generateFile('views/components/modals.php',  $data);
        $vue = $this->generateFile('views/base.php', ['title' => $this->t, 'css' => $this->css, 'content' => $content, 'sidebar' => $sideBar, 'topbar' => $topbar, 'modals' => $modals]);
        return $vue;

        /*$vue = $this->generateFile($this->file, $data);
        $filename = 'un_nom';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($vue);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'Landscape');

        // Render the HTML as PDF
        $dompdf->render();

        $canvas = $dompdf->getCanvas();

        $canvas->page_text(35, 20, lang['Audit report'] . " EVE VEGAN",
            'helvetica-bold', 12, array(0,0,0));
        $canvas->page_text(35, 36, lang['Version'] . " " . Version,
            'Helvetica', 12, array(0,0,0));
        $canvas->page_text(35, 52, lang['Confidential document'] . " : " . date('d/m/Y') ,
            'Helvetica', 12, array(0,0,0));
        $canvas->page_text(35, 550, "EXPERTISE VEGANE EUROPE, 5 rue Auguste Rodin, 2860 Le Coudray, France",
            '', 12, array(0,0,0));
        $canvas->page_text(780, 550, "{PAGE_NUM}/{PAGE_COUNT}",
            '', 12, array(0,0,0));

        $dompdf->stream($filename .'.pdf',array('Attachment'=>0));*/

    }

    // Met la vue dans un buffer et la retourne
    private function generateFile($file, $data){
        if (file_exists($file)){
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else{
            throw new Exception('Fichier introuvable');
        }
    }

    /**
     * @param mixed $t
     */
    public function setT($t)
    {
        $this->t = $t;
    }

    /**
     * @param mixed $script
     */
    public function setScript($script): void
    {
        $this->script = $script;
    }

    /**
     * @param mixed $css
     */
    public function setCss($css): void
    {
        $this->css = $css;
    }

    /**
     * @param mixed $js
     */
    public function setJs($js): void
    {
        $this->js = $js;
    }

}