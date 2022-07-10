<?php
namespace AdminPanel\Controller\Component;

use Box\Spout\Common\Entity\Style\Color;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Cake\I18n\Time;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Laminas\Diactoros\Stream;

/**
 * ExportExcel component
 */
class ExportExcelComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    protected $filename = '';

    protected $row = 0;

    /**
     * @var \Box\Spout\Writer\XLSX\Writer $writer
     */
    protected $writer;

    public function initialize(array $config)
    {
        parent::initialize($config);
    }


    /**
     * @return \Box\Spout\Writer\XLSX\Writer
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @param null $file_name
     * @param bool $open_browser
     * @return $this
     * @throws \Box\Spout\Common\Exception\IOException
     */
    public function init($file_name = null, $open_browser = true)
    {
        $this->getController()->disableAutoRender();
        $this->row = 0;
        $this->writer = WriterEntityFactory::createXLSXWriter();
        $this->filename = empty($file_name) ? TMP . uniqid('excel')  . '.xlsx' : $file_name;
        if ($open_browser) {
            $this->writer->openToBrowser($this->filename);
        } else {
            $this->writer->openToFile($this->filename);
        }

        return $this;
    }




    /**
     * @param array $cells
     * @return $this
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function addHeader(array $cells = [])
    {
        foreach($cells as &$cell) {
            $cell = WriterEntityFactory::createCell($cell);
        }

        $style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(12)
            ->setFontColor(Color::BLACK)
            ->setShouldWrapText()
            ->setBackgroundColor('EFEFEF')
            ->build();

        $this->writer->addRow(WriterEntityFactory::createRow($cells, $style));

        return $this;
    }

    /**
     * @param string $color
     * @return \Box\Spout\Common\Entity\Style\Style
     */
    public function addBackground($color = 'EFEFEF')
    {
        return (new StyleBuilder())
            ->setBackgroundColor($color)
            ->build();
    }

    /**
     * @param array $rows
     * @param false $use_odd
     * @param string $color
     * @return $this
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function addRow(array $rows = [], $use_odd = false, $color = 'EFEFEF')
    {
        $style = $use_odd ? ($this->row % 2 == 1 ? $this->addBackground($color) : null) : null;
        $this->writer->addRow(WriterEntityFactory::createRowFromArray($rows, $style));
        $this->row++;
        return $this;
    }

    /**
     *
     */
    public function close()
    {
        $this->writer->close();
        $response =  $this
            ->getController()
            ->getResponse()
            ->withType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            ->withDownload(
                'Export-' .
                $this->getController()->getName() .
                '-' .
                date('Y-m-d') .
                '.xlsx'
            );

        register_shutdown_function(function ()  {
            if (file_exists($this->filename)) {
                unlink($this->filename);
            }
        });

        return $response
            ->withBody(new Stream($this->filename, 'rb'));
    }



}
