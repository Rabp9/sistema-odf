<?php

/**
 * CakePHP ReportesController
 * @author Roberto
 */
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel/PHPExcel.php'));

class ReportesController extends AppController {
    
    public $uses = array("Departamento", "Provincia", "Urd");
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("index", "Provincias", "Urds");
    }
    
    public $estiloTituloReporte = array(
        'font' => array(
            'name'      => 'Bookman Old Style',
            'bold'      => true,
            'italic'    => false,
            'strike'    => false,
            'size' => 16,
            'color'     => array(
                'rgb' => '0000FF'
            )
        ),
        'fill' => array(
            'type'  => PHPExcel_Style_Fill::FILL_SOLID
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation' => 0,
            'wrap' => TRUE
        )
    );
    
    public $estiloTituloColumnas = array(
        'font' => array(
            'name'  => 'TheSansCorrespondence',
            'bold'  => true,
            'color' => array(
                'rgb' => '0000FF'
            )
        ),
        'fill' => array(
            'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
            'startcolor' => array(
                'rgb' => 'B2C2CA'
            ),
            'endcolor' => array(
                'argb' => 'DBDBEA'
            )
        ),
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                'color' => array(
                    'rgb' => '143860'
                )
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                'color' => array(
                    'rgb' => '143860'
                )
            )
        ),
        'alignment' =>  array(
            'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap'      => TRUE
        )
    );
    
    public function index() {
        $this->layout = "excel"; //this will use the pdf.ctp layout

        $objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        
        $objPHPExcel->getProperties()->setCreator($this->Auth->user()["username"]) // Nombre del autor
            ->setTitle("Reporte de Departamentos") // Titulo
            ->setSubject("Reporte de Departamentos") //Asunto
            ->setDescription("Reporte de Departamentos") //Descripción
            ->setKeywords("reporte departamentos") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
       
        $tituloReporte = "Relación de Departamentos";
        $titulosColumnas = array("Código", "Descripción", "Cantidad Provincias");
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:C2');
 
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $tituloReporte) // Titulo del reporte
            ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2]);
        
        //Numero de fila donde se va a comenzar a rellenar
        $departamentos = $this->Departamento->find("all", array(
           "conditions" => array("Departamento.estado" => 1) 
        ));
        $i = 4;
        foreach($departamentos as $departamento) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $departamento["Departamento"]["id"])
                ->setCellValue('B'.$i, $departamento["Departamento"]["descripcion"])
                ->setCellValue('C'.$i, sizeof($departamento["Provincia"]));
            $i++;
        }
        
        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray( array(
            'font' => array(
                'name'  => 'TheSansCorrespondence',
                'color' => array(
                    'rgb' => '000000'
                )
            ),
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array(
                    'argb' => 'BBBBFF')
            ),
            'borders' => array(
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array(
                        'rgb' => '3a2a47'
                    )
                )
            )
        ));
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($this->estiloTituloReporte);
        $objPHPExcel->getActiveSheet()->getStyle('A3:C3')->applyFromArray($this->estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:C".($i-1));
        
        // Ancho de Columnas
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(12);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(20);
        
        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('Departamentos');

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        $this->response->type("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        $this->response->cache(0);
        header('Content-Disposition: attachment;filename="Reporte-de-Departamentos.xlsx"');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    
    public function provincias() {
        $this->layout = "excel"; //this will use the pdf.ctp layout

        $objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        
        $objPHPExcel->getProperties()->setCreator($this->Auth->user()["username"]) // Nombre del autor
            ->setTitle("Reporte de Provincias") // Titulo
            ->setSubject("Reporte de Provincias") //Asunto
            ->setDescription("Reporte de Provincias") //Descripción
            ->setKeywords("reporte provincias") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
       
        $tituloReporte = "Relación de Provincias";
        $titulosColumnas = array("Código", "Descripción", "Departamento", "Cantidad URD's");
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:D2');
 
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $tituloReporte) // Titulo del reporte
            ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3',  $titulosColumnas[1])
            ->setCellValue('C3',  $titulosColumnas[2])
            ->setCellValue('D3',  $titulosColumnas[3]);
        
        //Numero de fila donde se va a comenzar a rellenar
        $provincias = $this->Provincia->find("all", array(
           "conditions" => array("Provincia.estado" => 1) 
        ));
        $i = 4;
        foreach($provincias as $provincia) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $provincia["Provincia"]["id"])
                ->setCellValue('B'.$i, $provincia["Provincia"]["descripcion"])
                ->setCellValue('C'.$i, $provincia["Departamento"]["descripcion"])
                ->setCellValue('D'.$i, sizeof($provincia["Urd"]));
            $i++;
        }

        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray( array(
            'font' => array(
                'name'  => 'TheSansCorrespondence',
                'color' => array(
                    'rgb' => '000000'
                )
            ),
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array(
                    'argb' => 'BBBBFF')
            ),
            'borders' => array(
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array(
                        'rgb' => '3a2a47'
                    )
                )
            )
        ));
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($this->estiloTituloReporte);
        $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($this->estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:D".($i-1));
        
        // Ancho de Columnas
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(12);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(20);
        
        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('Provincias');

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        $this->response->type("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        $this->response->cache(0);
        header('Content-Disposition: attachment;filename="Reporte-de-Provincias.xlsx"');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    
    public function urds() {
        $this->layout = "excel"; //this will use the pdf.ctp layout

        $objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        
        $objPHPExcel->getProperties()->setCreator($this->Auth->user()["username"]) // Nombre del autor
            ->setTitle("Reporte de URD's") // Titulo
            ->setSubject("Reporte de URD's") //Asunto
            ->setDescription("Reporte de URD's") //Descripción
            ->setKeywords("reporte urds") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
       
        $tituloReporte = "Relación de URD's";
        $titulosColumnas = array("Código", "Descripción", "Dirección", "Provincia", "Departamento", "Cantidad ODF's");
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:F2');
 
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $tituloReporte) // Titulo del reporte
            ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3', $titulosColumnas[1])
            ->setCellValue('C3', $titulosColumnas[2])
            ->setCellValue('D3', $titulosColumnas[3])
            ->setCellValue('E3', $titulosColumnas[4])
            ->setCellValue('F3', $titulosColumnas[5]);
        
        //Numero de fila donde se va a comenzar a rellenar
        $this->Urd->recursive = 2;
        $urds = $this->Urd->find("all", array(
           "conditions" => array("Urd.estado" => 1) 
        ));
        $i = 4;
        foreach($urds as $urd) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $urd["Urd"]["id"])
                ->setCellValue('B'.$i, $urd["Urd"]["descripcion"])
                ->setCellValue('C'.$i, $urd["Urd"]["direccion"])
                ->setCellValue('D'.$i, $urd["Provincia"]["descripcion"])
                ->setCellValue('E'.$i, $urd["Provincia"]["Departamento"]["descripcion"])
                ->setCellValue('F'.$i, sizeof($urd["Odf"]));
            $i++;
        }

        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray( array(
            'font' => array(
                'name'  => 'TheSansCorrespondence',
                'color' => array(
                    'rgb' => '000000'
                )
            ),
            'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array(
                    'argb' => 'BBBBFF')
            ),
            'borders' => array(
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                'color' => array(
                        'rgb' => '3a2a47'
                    )
                )
            )
        ));
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($this->estiloTituloReporte);
        $objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($this->estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:F".($i-1));
        
        // Ancho de Columnas
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(12);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(40);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(20);
        
        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('URD\'s');

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        $this->response->type("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        $this->response->cache(0);
        header('Content-Disposition: attachment;filename="Reporte-de-URD\'s.xlsx"');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}
