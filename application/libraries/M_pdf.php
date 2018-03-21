<?

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__ . '/../../vendor/autoload.php';

//include_once APPPATH.'/third_party/mpdf/mpdf.php';

class m_pdf {
    
    public $param;
    public $pdf;
 
    public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    {
        $this->param = $param;
        $this->pdf = new \Mpdf\Mpdf(array(595.28,841.89));
    }
}
?>