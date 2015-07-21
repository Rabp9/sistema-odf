<?php

/**
 * CakePHP ReportesController
 * @author Roberto
 */
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel/PHPExcel.php'));

class ReportesController extends AppController {  
    
    public $uses = array("Departamento", "Provincia", "Urd", "Odf");
    
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
    
    public function departamentos() {
        $this->layout = "admin";
        
        $this->set("departamentos", $this->Departamento->find("all", array(
            'conditions' => array('Departamento.estado' => '1')
        )));
    }

    public function departamentos_post() {
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
        $titulosColumnas = array("Código", "Departamento", "Cantidad Provincias");
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
        $this->layout = "admin";

        $this->set("provincias", $this->Provincia->find("all", array(
            'conditions' => array('Provincia.estado' => '1')
        )));
    }
    
    public function provincias_post() {
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
        $titulosColumnas = array("Código", "Provincia", "Departamento", "Cantidad URD's");
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
        $this->layout = "admin";

        $this->Urd->recursive = 2;
        $this->set("urds", $this->Urd->find("all", array(
            'conditions' => array('Urd.estado' => '1')
        )));
    }
    
    public function urds_post() {
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
        $titulosColumnas = array("Código", "URD", "Dirección", "Provincia", "Departamento", "Cantidad ODF's");
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
    
    public function odfs() {
        $this->layout = "admin";

        $this->Odf->recursive = 4;
        $odfs = $this->Odf->find("all", array(
            'conditions' => array('Odf.estado' => '1')
        ));
        $odfs = $this->conectores_libres($odfs);
        $this->set(compact("odfs"));
    }
       
    public function odfs_post() {
        $this->layout = "excel"; //this will use the pdf.ctp layout

        $objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        
        $objPHPExcel->getProperties()->setCreator($this->Auth->user()["username"]) // Nombre del autor
            ->setTitle("Reporte de ODF's") // Titulo
            ->setSubject("Reporte de ODF's") //Asunto
            ->setDescription("Reporte de ODF's") //Descripción
            ->setKeywords("reporte odfs") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
       
        $tituloReporte = "Relación de ODF's";
        $titulosColumnas = array("Código", "URD", "Provincia", "Departamento", "Numeración", "N. Cables", "Tam. Base de Conector", "N. Tubos de Fibra", "Conectores de Fibra Libres");
        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A1:I2');
 
        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $tituloReporte) // Titulo del reporte
            ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B3', $titulosColumnas[1])
            ->setCellValue('C3', $titulosColumnas[2])
            ->setCellValue('D3', $titulosColumnas[3])
            ->setCellValue('E3', $titulosColumnas[4])
            ->setCellValue('F3', $titulosColumnas[5])
            ->setCellValue('G3', $titulosColumnas[6])
            ->setCellValue('H3', $titulosColumnas[7])
            ->setCellValue('I3', $titulosColumnas[8]);
        
        //Numero de fila donde se va a comenzar a rellenar
        $this->Odf->recursive = 4;
        $odfs = $this->Odf->find("all", array(
            'conditions' => array('Odf.estado' => '1')
        ));
        $odfs = $this->conectores_libres($odfs);
        $i = 4;
        foreach($odfs as $odf) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $odf["Odf"]["id"])
                ->setCellValue('B'.$i, $odf["Urd"]["descripcion"])
                ->setCellValue('C'.$i, $odf["Urd"]["Provincia"]["descripcion"])
                ->setCellValue('D'.$i, $odf["Urd"]["Provincia"]["Departamento"]["descripcion"])
                ->setCellValue('E'.$i, $odf["Odf"]["numeracion"])
                ->setCellValue('F'.$i, $odf["Odf"]["numero_cables"])
                ->setCellValue('G'.$i, $odf["Odf"]["tam_bc"])
                ->setCellValue('H'.$i, sizeof($odf["Tubofibra"]))
                ->setCellValue('I'.$i, $odf["Odf"]["n_conectores_libres"]);
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
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($this->estiloTituloReporte);
        $objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($this->estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:I".($i-1));
        
        // Ancho de Columnas
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(12);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(35);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(16);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(16);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("G")->setWidth(16);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("H")->setWidth(16);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("I")->setWidth(16);
        
        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('ODF\'s');

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
        
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        $this->response->type("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        $this->response->cache(0);
        header('Content-Disposition: attachment;filename="Reporte-de-ODF\'s.xlsx"');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    
    private function conectores_libres($odfs) {
        foreach($odfs as $k_odf => $odf) {
            $n = 0;
            foreach($odf["Tubofibra"] as $k_tubofibra => $tubofibra) {
                foreach($tubofibra["Be"] as $k_be => $be) {
                    foreach($be["Bc"] as $k_bc => $bc) {
                        foreach($bc["Conectorfibra"] as $k_conectorfibra => $conectorfibra) {
                            if($conectorfibra["tipos_id"] == 1) {
                                $n += 1;
                            }
                        }
                    }
                }
            }
            $odfs[$k_odf]["Odf"]["n_conectores_libres"] = $n;
        }
        return $odfs;
    }
    
    public function reporte_odf($id) {
        $this->layout = "excel"; //this will use the pdf.ctp layout

        $objPHPExcel = new PHPExcel();
        // Se asignan las propiedades del libro
        
        $objPHPExcel->getProperties()->setCreator($this->Auth->user()["username"]) // Nombre del autor
            ->setTitle("Reporte de ODF") // Titulo
            ->setSubject("Reporte de ODF") //Asunto
            ->setDescription("Reporte de ODF") //Descripción
            ->setKeywords("reporte odf") //Etiquetas
            ->setCategory("Reporte excel"); //Categorias
        
        $this->Odf->recursive = 5;
        $odf = $this->Odf->findById($id);
        
        $tipo = array(
            "1" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => 'FFFFFF')
                )
            ),
            "2" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => 'FFFF00')
                )
            ),
            "3" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => '9933FF')
                )
            ),
            "4" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => '66FFFF')
                )
            ),
            "5" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => 'CC99FF')
                )
            ),
            "6" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => 'FF0000')
                )
            ),
            "7" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => '999999')
                )
            ),
            "8" => array(
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'rgb' => '92D050')
                )
            )
        );
        
        switch ($odf["Odf"]["tam_bc"]) {
            case 2:
                // Título
                $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells("A2:D2")
                    ->mergeCells("A3:D3")
                    ->mergeCells("A4:D4")
                    ->mergeCells("A5:D5");

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A2", "Departamento: " . $odf["Urd"]["Provincia"]["Departamento"]["descripcion"])
                    ->setCellValue("A3", "Provincia: " . $odf["Urd"]["Provincia"]["descripcion"])
                    ->setCellValue("A4", "URD: " . $odf["Urd"]["descripcion"])
                    ->setCellValue("A5", "Número de ODF: " . $odf["Odf"]["numeracion"]);
                
                $estilo_titulo = new PHPExcel_Style();
                $estilo_titulo->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '0000FF'
                        ),
                        'size' => 14,
                        'bold'      => true,
                        'italic'    => true
                    )
                ));
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_titulo, "A2:A5");
                
                // Cabecera
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A7", "CABLE")
                    ->setCellValue("B7", "BAN. E.")
                    ->setCellValue("C7", "BAN. C.")
                    ->setCellValue("D7", "ASIGNACIÓN");
                                
                $estilo_cabecera = new PHPExcel_Style();
                $estilo_cabecera->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => 'FFFFFF'
                        ),
                        'size' => 10,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array(
                            'rgb' => '008080')
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                ));
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera, "A7:D7");
                $objPHPExcel->getActiveSheet()->getStyle("A7:D7")->applyFromArray($style);
                
                // Cuerpo
                $estilo_cuerpo_D = new PHPExcel_Style();
                $estilo_cuerpo_D->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D, "D8:D" . (7 + $odf["Odf"]["numero_cables"]));
                
                $inicio_tf = 8;
                foreach($odf["Tubofibra"] as $tubofibra) {
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("A" . $inicio_tf . ":A" . ( $inicio_tf - 1 + $tubofibra["numero_cables"] ));
                             
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A" . $inicio_tf, $tubofibra["id2"] . ": " . $tubofibra["descripcion"]);
                    
                    $inicio_be = $inicio_tf;
                    foreach($tubofibra["Be"] as $be) {
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->mergeCells("B" . $inicio_be . ":B" . ( $inicio_be - 1 + $be["numero_cables"] ));
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("B" . $inicio_be, $be["numeracion"]);
                        
                        $inicio_bc = $inicio_be;
                        foreach($be["Bc"] as $bc) {
                            $objPHPExcel->setActiveSheetIndex(0)
                                ->mergeCells("C" . $inicio_bc . ":C" . ( $inicio_bc - 1 + $bc["numero_cables"] ));

                            $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue("C" . $inicio_bc, $bc["numeracion"]);
                            
                            $inicio_cf = $inicio_bc;
                            foreach($bc["Conectorfibra"] as $conector) {
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue("D" . $inicio_cf, $conector["descripcion"]);
                                
                                $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf)->setRowHeight(30);
                                $objPHPExcel->getActiveSheet()->getStyle("D" . $inicio_cf)->applyFromArray($tipo[$conector["tipos_id"]]);  
                                
                                if($conector["tipos_id"] != 1) {
                                    //Comentario
                                    $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->setAuthor('Sistema-ODF');
                                    $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->setHeight(350);
                                    $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->setWidth(200);

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun('Numeraciòn: ' . $conector["numeracion"]);
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun('Intermedio:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun(!empty($conector["intermedio"]) ? $conector["intermedio"] : " ");  
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");                             

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun('Gestor:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun($conector["Gestor"]["descripcion"]);
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun('Ubicación del Gestor:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun(!empty($conector["gestor_ubicacion"]) ? $conector["gestor_ubicacion"] : " ");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun('Observación:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun(!empty($conector["observacion"]) ? $conector["observacion"] : " ");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment("D" . $inicio_cf)->getText()->createTextRun("\r\n");
                                }
                                $inicio_cf += 1;
                            }
                            
                            $inicio_bc += $bc["numero_cables"];
                        }
                        
                        $inicio_be += $be["numero_cables"];
                    }
                    
                    $inicio_tf += $tubofibra["numero_cables"];
                }
                
                // Estilo A
                $estilo_cuerpo_A = new PHPExcel_Style();
                $estilo_cuerpo_A->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 8,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_A, "A8:A" . (7 + $odf["Odf"]["numero_cables"]));
                $objPHPExcel->getActiveSheet()->getStyle("A8:A" . (7 + $odf["Odf"]["numero_cables"]))->applyFromArray($style);
                $objPHPExcel->getActiveSheet()->getStyle("A8:A" . (7 + $odf["Odf"]["numero_cables"]))->getAlignment()->setTextRotation(90);
                        
                // Estilo B
                $estilo_cuerpo_B = new PHPExcel_Style();
                $estilo_cuerpo_B->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_B, "B8:B" . (7 + $odf["Odf"]["numero_cables"]));
                $objPHPExcel->getActiveSheet()->getStyle("B8:B" . (7 + $odf["Odf"]["numero_cables"]))->applyFromArray($style);
                    
                // Estilo C
                $estilo_cuerpo_C = new PHPExcel_Style();
                $estilo_cuerpo_C->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_C, "C8:C" . (7 + $odf["Odf"]["numero_cables"]));
                $objPHPExcel->getActiveSheet()->getStyle("C8:C" . (7 + $odf["Odf"]["numero_cables"]))->applyFromArray($style);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(5);
                
                // Estilo D
               
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->getStyle("D8:D" . (7 + $odf["Odf"]["numero_cables"]))->applyFromArray($style);  
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(30);
                
                break;
            case 4:
                // Título
                $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells("A2:I2")
                    ->mergeCells("A3:I3")
                    ->mergeCells("A4:I4")
                    ->mergeCells("A5:I5");

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A2", "Departamento: " . $odf["Urd"]["Provincia"]["Departamento"]["descripcion"])
                    ->setCellValue("A3", "Provincia: " . $odf["Urd"]["Provincia"]["descripcion"])
                    ->setCellValue("A4", "URD: " . $odf["Urd"]["descripcion"])
                    ->setCellValue("A5", "Número de ODF: " . $odf["Odf"]["numeracion"]);
                
                $estilo_titulo = new PHPExcel_Style();
                $estilo_titulo->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '0000FF'
                        ),
                        'size' => 14,
                        'bold'      => true,
                        'italic'    => true
                    )
                ));
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_titulo, "A2:A5");
                
                // Cabecera
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A7", "CABLE")
                    ->setCellValue("B7", "BAN. E.")
                    ->setCellValue("C7", "BAN. C.")
                    ->setCellValue("D7", "FO")
                    ->setCellValue("E7", "ASIGNACIÓN")
                    ->setCellValue("F7", "FO")
                    ->setCellValue("G7", "FO")
                    ->setCellValue("H7", "ASIGNACIÓN")
                    ->setCellValue("I7", "FO");
                                
                $estilo_cabecera = new PHPExcel_Style();
                $estilo_cabecera->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => 'FFFFFF'
                        ),
                        'size' => 10,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array(
                            'rgb' => '808080')
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                ));
                             
                $estilo_cabecera_2 = new PHPExcel_Style();
                $estilo_cabecera_2->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array(
                            'rgb' => 'FFFFFF')
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                ));
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera, "A7:i7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "D7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "F7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "G7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "I7");
                $objPHPExcel->getActiveSheet()->getStyle("A7:I7")->applyFromArray($style);
                
                // Cuerpo
                $estilo_cuerpo_E_H = new PHPExcel_Style();
                $estilo_cuerpo_E_H->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_E_H, "E8:E" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_E_H, "H8:H" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                
                $inicio_tf = 8;
                foreach($odf["Tubofibra"] as $tubofibra) {
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("A" . $inicio_tf . ":A" . ( $inicio_tf - 1 + ($tubofibra["numero_cables"] / 2)));
                             
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A" . $inicio_tf, $tubofibra["id2"] . ": " . $tubofibra["descripcion"]);
                    
                    $inicio_be = $inicio_tf;
                    foreach($tubofibra["Be"] as $be) {
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->mergeCells("B" . $inicio_be . ":B" . ( $inicio_be - 1 + ($be["numero_cables"] / 2)));
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("B" . $inicio_be, $be["numeracion"]);
                       
                        $inicio_bc = $inicio_be;
                        foreach($be["Bc"] as $bc) {
                            $objPHPExcel->setActiveSheetIndex(0)
                                ->mergeCells("C" . $inicio_bc . ":C" . ( $inicio_bc - 1 + ($bc["numero_cables"] / 2)));

                            $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue("C" . $inicio_bc, $bc["numeracion"]);
                            
                            $inicio_cf = $inicio_bc;
                            $auxiliar = 1;
                            foreach($bc["Conectorfibra"] as $conector) {
                                $celda = "";
                                if($auxiliar == 1) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("E" . $inicio_cf, $conector["descripcion"]);
                                    $celda = "E" . $inicio_cf;
                                            
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("D" . $inicio_cf . ":D" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("D" . $inicio_cf, $conector["numeracion"]);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf)->setRowHeight(30);
                                } elseif($auxiliar == 2) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("E" . ($inicio_cf + 1), $conector["descripcion"]);
                                    $celda = "E" . ($inicio_cf + 1);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("F" . $inicio_cf . ":F" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("F" . $inicio_cf, $conector["numeracion"]);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf + 1)->setRowHeight(30);
                                } elseif($auxiliar == 3) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("H" . $inicio_cf, $conector["descripcion"]);
                                    $celda = "H" . $inicio_cf;
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("G" . $inicio_cf . ":G" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("G" . $inicio_cf, $conector["numeracion"]);
                                } elseif($auxiliar == 4) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("H" . ($inicio_cf + 1), $conector["descripcion"]);
                                    $celda = "H" . ($inicio_cf + 1);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("I" . $inicio_cf . ":I" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("I" . $inicio_cf, $conector["numeracion"]);
                                    $inicio_cf += 2;
                                }
                                   
                                $objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($tipo[$conector["tipos_id"]]);              
                                if($conector["tipos_id"] != 1) {
                                    //Comentario
                                    $objPHPExcel->getActiveSheet()->getComment($celda)->setAuthor('Sistema-ODF');
                                    $objPHPExcel->getActiveSheet()->getComment($celda)->setHeight(350);
                                    $objPHPExcel->getActiveSheet()->getComment($celda)->setWidth(200);

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Numeraciòn: ' . $conector["numeracion"]);
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Intermedio:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["intermedio"]) ? $conector["intermedio"] : " ");  
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");                             

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Gestor:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun($conector["Gestor"]["descripcion"]);
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Ubicación del Gestor:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["gestor_ubicacion"]) ? $conector["gestor_ubicacion"] : " ");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Observación:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["observacion"]) ? $conector["observacion"] : " ");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                }
                                
                                $auxiliar += 1;
                            }
                            
                            $inicio_bc += $bc["numero_cables"] / 2;
                        }
                        $inicio_be += $be["numero_cables"] / 2;
                    }
                    $inicio_tf += $tubofibra["numero_cables"] / 2;
                }
                          
                // Estilo A
                $estilo_cuerpo_A = new PHPExcel_Style();
                $estilo_cuerpo_A->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 8,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_A, "A8:A" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("A8:A" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                $objPHPExcel->getActiveSheet()->getStyle("A8:A" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->getAlignment()->setTextRotation(90);
                        
                // Estilo B
                $estilo_cuerpo_B = new PHPExcel_Style();
                $estilo_cuerpo_B->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_B, "B8:B" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("B8:B" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                    
                // Estilo C
                $estilo_cuerpo_C = new PHPExcel_Style();
                $estilo_cuerpo_C->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_C, "C8:C" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("C8:C" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                                
                // Estilo D, F, G, I
                $estilo_cuerpo_D_F_G_I = new PHPExcel_Style();
                $estilo_cuerpo_D_F_G_I->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I, "D8:D" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("D8:D" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                   
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I, "F8:F" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("F8:F" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I, "G8:G" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("G8:G" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
               
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I, "I8:I" . (7 + ($odf["Odf"]["numero_cables"] / 2)));
                $objPHPExcel->getActiveSheet()->getStyle("I8:I" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                             
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("G")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("I")->setWidth(5);
                            
                // Estilo E, H
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->getStyle("E8:E" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);  
                $objPHPExcel->getActiveSheet()->getStyle("H8:H" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(30);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("H")->setWidth(30);
                
                break;
                
            case 8:
                // Título
                $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells("A2:I2")
                    ->mergeCells("A3:I3")
                    ->mergeCells("A4:I4")
                    ->mergeCells("A5:I5");

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A2", "Departamento: " . $odf["Urd"]["Provincia"]["Departamento"]["descripcion"])
                    ->setCellValue("A3", "Provincia: " . $odf["Urd"]["Provincia"]["descripcion"])
                    ->setCellValue("A4", "URD: " . $odf["Urd"]["descripcion"])
                    ->setCellValue("A5", "Número de ODF: " . $odf["Odf"]["numeracion"]);
                
                $estilo_titulo = new PHPExcel_Style();
                $estilo_titulo->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '0000FF'
                        ),
                        'size' => 14,
                        'bold'      => true,
                        'italic'    => true
                    )
                ));
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_titulo, "A2:A5");
                
                // Cabecera
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A7", "CABLE")
                    ->setCellValue("B7", "BAN. E.")
                    ->setCellValue("C7", "BAN. C.")
                    ->setCellValue("D7", "FO")
                    ->setCellValue("E7", "ASIGNACIÓN")
                    ->setCellValue("F7", "FO")
                    ->setCellValue("G7", "FO")
                    ->setCellValue("H7", "ASIGNACIÓN")
                    ->setCellValue("I7", "FO")
                    ->setCellValue("J7", "FO")
                    ->setCellValue("K7", "ASIGNACIÓN")
                    ->setCellValue("L7", "FO")
                    ->setCellValue("M7", "FO")
                    ->setCellValue("N7", "ASIGNACIÓN")
                    ->setCellValue("O7", "FO");
                                
                $estilo_cabecera = new PHPExcel_Style();
                $estilo_cabecera->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => 'FFFFFF'
                        ),
                        'size' => 10,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array(
                            'rgb' => '808080')
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                ));
                             
                $estilo_cabecera_2 = new PHPExcel_Style();
                $estilo_cabecera_2->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array(
                            'rgb' => 'FFFFFF')
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                ));
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera, "A7:O7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "D7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "F7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "G7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "I7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "J7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "L7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "M7");
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "O7");
                $objPHPExcel->getActiveSheet()->getStyle("A7:O7")->applyFromArray($style);
                
                // Cuerpo
                $estilo_cuerpo_E_H_K_N = new PHPExcel_Style();
                $estilo_cuerpo_E_H_K_N->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_E_H_K_N, "E8:E" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_E_H_K_N, "H8:H" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_E_H_K_N, "K8:K" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_E_H_K_N, "N8:N" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                
                $inicio_tf = 8;
                foreach($odf["Tubofibra"] as $tubofibra) {
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("A" . $inicio_tf . ":A" . ( $inicio_tf - 1 + ($tubofibra["numero_cables"] / 4)));
                             
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A" . $inicio_tf, $tubofibra["id2"] . ": " . $tubofibra["descripcion"]);
                    
                    $inicio_be = $inicio_tf;
                    foreach($tubofibra["Be"] as $be) {
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->mergeCells("B" . $inicio_be . ":B" . ( $inicio_be - 1 + ($be["numero_cables"] / 4)));
                        
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("B" . $inicio_be, $be["numeracion"]);
                       
                        $inicio_bc = $inicio_be;
                        foreach($be["Bc"] as $bc) {
                            $objPHPExcel->setActiveSheetIndex(0)
                                ->mergeCells("C" . $inicio_bc . ":C" . ( $inicio_bc - 1 + ($bc["numero_cables"] / 4)));

                            $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue("C" . $inicio_bc, $bc["numeracion"]);
                            
                            $inicio_cf = $inicio_bc;
                            $auxiliar = 1;
                            foreach($bc["Conectorfibra"] as $conector) {
                                $celda = "";
                                if($auxiliar == 1) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("E" . $inicio_cf, $conector["descripcion"]);
                                    $celda = "E" . $inicio_cf;
                                            
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("D" . $inicio_cf . ":D" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("D" . $inicio_cf, $conector["numeracion"]);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf)->setRowHeight(30);
                                } elseif($auxiliar == 2) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("E" . ($inicio_cf + 1), $conector["descripcion"]);
                                    $celda = "E" . ($inicio_cf + 1);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("F" . $inicio_cf . ":F" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("F" . $inicio_cf, $conector["numeracion"]);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf + 1)->setRowHeight(30);
                                } elseif($auxiliar == 3) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("H" . $inicio_cf, $conector["descripcion"]);
                                    $celda = "H" . $inicio_cf;
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("G" . $inicio_cf . ":G" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("G" . $inicio_cf, $conector["numeracion"]);
                                } elseif($auxiliar == 4) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("H" . ($inicio_cf + 1), $conector["descripcion"]);
                                    $celda = "H" . ($inicio_cf + 1);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("I" . $inicio_cf . ":I" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("I" . $inicio_cf, $conector["numeracion"]);
                                } elseif($auxiliar == 5) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("K" . $inicio_cf, $conector["descripcion"]);
                                    $celda = "K" . $inicio_cf;
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("J" . $inicio_cf . ":J" . ($inicio_cf + 1) );
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("J" . $inicio_cf, $conector["numeracion"]);
                                } elseif($auxiliar == 6) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("K" . ($inicio_cf + 1), $conector["descripcion"]);
                                    $celda = "K" . ($inicio_cf + 1);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("L" . $inicio_cf . ":L" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("L" . $inicio_cf, $conector["numeracion"]);
                                } elseif($auxiliar == 7) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("N" . $inicio_cf, $conector["descripcion"]);
                                    $celda = "N" . $inicio_cf;
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("M" . $inicio_cf . ":M" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("M" . $inicio_cf, $conector["numeracion"]);
                                } elseif($auxiliar == 8) {
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("N" . ($inicio_cf + 1), $conector["descripcion"]);
                                    $celda = "N" . ($inicio_cf + 1);
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->mergeCells("O" . $inicio_cf . ":O" . ($inicio_cf + 1));
                                    
                                    $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue("O" . $inicio_cf, $conector["numeracion"]);
                                    
                                    $inicio_cf += 2;
                                }
                                   
                                $objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($tipo[$conector["tipos_id"]]);              
                                if($conector["tipos_id"] != 1) {
                                    //Comentario
                                    $objPHPExcel->getActiveSheet()->getComment($celda)->setAuthor('Sistema-ODF');
                                    $objPHPExcel->getActiveSheet()->getComment($celda)->setHeight(350);
                                    $objPHPExcel->getActiveSheet()->getComment($celda)->setWidth(200);

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Numeraciòn: ' . $conector["numeracion"]);
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Intermedio:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["intermedio"]) ? $conector["intermedio"] : " ");  
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");                             

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Gestor:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun($conector["Gestor"]["descripcion"]);
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Ubicación del Gestor:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["gestor_ubicacion"]) ? $conector["gestor_ubicacion"] : " ");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Observación:');
                                    $objCommentRichText->getFont()->setBold(true); 
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["observacion"]) ? $conector["observacion"] : " ");
                                    $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                }
                                
                                $auxiliar += 1;
                            }
                            $inicio_bc += $bc["numero_cables"] / 4;
                        }
                        $inicio_be += $be["numero_cables"] / 4;
                    }
                    $inicio_tf += $tubofibra["numero_cables"] / 4;
                }
                
                // Estilo A
                $estilo_cuerpo_A = new PHPExcel_Style();
                $estilo_cuerpo_A->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 8,
                        'bold'      => true,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_A, "A8:A" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("A8:A" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                $objPHPExcel->getActiveSheet()->getStyle("A8:A" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->getAlignment()->setTextRotation(90);
                        
                // Estilo B
                $estilo_cuerpo_B = new PHPExcel_Style();
                $estilo_cuerpo_B->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_B, "B8:B" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("B8:B" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                     
                // Estilo C
                $estilo_cuerpo_C = new PHPExcel_Style();
                $estilo_cuerpo_C->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_C, "C8:C" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("C8:C" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
               
                // Estilo D, F, G, I, J, L, M, O
                $estilo_cuerpo_D_F_G_I_J_L_M_O = new PHPExcel_Style();
                $estilo_cuerpo_D_F_G_I_J_L_M_O->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '000000'
                        ),
                        'size' => 10,
                        'bold'      => false,
                        'italic'    => false
                    ),
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array(
                            'rgb' => 'D9D9D9')
                    ),
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        )
                    )
                )); 
                
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );

                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "D8:D" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("D8:D" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                   
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "F8:F" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("F8:F" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "G8:G" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("G8:G" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
               
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "I8:I" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("I8:I" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                             
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "J8:J" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("J8:J" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "L8:L" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("L8:L" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                             
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "M8:M" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("M8:M" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_D_F_G_I_J_L_M_O, "O8:O" . (7 + ($odf["Odf"]["numero_cables"] / 4)));
                $objPHPExcel->getActiveSheet()->getStyle("O8:O" . (7 + ($odf["Odf"]["numero_cables"] / 4)))->applyFromArray($style);
                
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("G")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("I")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("J")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("L")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("M")->setWidth(5);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("O")->setWidth(5);
                
                // Estilo E, H, K, N
                $style = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
                );
                
                $objPHPExcel->getActiveSheet()->getStyle("E8:E" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);  
                $objPHPExcel->getActiveSheet()->getStyle("H8:H" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                $objPHPExcel->getActiveSheet()->getStyle("K8:K" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);  
                $objPHPExcel->getActiveSheet()->getStyle("N8:N" . (7 + ($odf["Odf"]["numero_cables"] / 2)))->applyFromArray($style);
                
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(30);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("H")->setWidth(30);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("K")->setWidth(30);
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("N")->setWidth(30);
                
                break;
                
            case 16:
                // Título
                $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells("A2:Y2")
                    ->mergeCells("A3:Y3")
                    ->mergeCells("A4:Y4")
                    ->mergeCells("A5:Y5");

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A2", "Departamento: " . $odf["Urd"]["Provincia"]["Departamento"]["descripcion"])
                    ->setCellValue("A3", "Provincia: " . $odf["Urd"]["Provincia"]["descripcion"])
                    ->setCellValue("A4", "URD: " . $odf["Urd"]["descripcion"])
                    ->setCellValue("A5", "Número de ODF: " . $odf["Odf"]["numeracion"]);
                
                $estilo_titulo = new PHPExcel_Style();
                $estilo_titulo->applyFromArray( array(
                    'font' => array(
                        'name'  => 'TheSansCorrespondence',
                        'color' => array(
                            'rgb' => '0000FF'
                        ),
                        'size' => 14,
                        'bold'      => true,
                        'italic'    => true
                    )
                ));
                
                $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_titulo, "A2:A5");
                
                // Cuerpo
                $inicio_tf = 7;
                foreach($odf["Tubofibra"] as $tubofibra) {
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("A" . $inicio_tf . ":A" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A" . $inicio_tf, "Tubo de Fibra");
                    
                    // Bandeja de Empalme
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("B" . $inicio_tf . ":D" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("B" . $inicio_tf, "BANDEJA EMPALME-1");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("E" . $inicio_tf . ":G" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("E" . $inicio_tf, "BANDEJA EMPALME-2");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("H" . $inicio_tf . ":J" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H" . $inicio_tf, "BANDEJA EMPALME-3");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("K" . $inicio_tf . ":M" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K" . $inicio_tf, "BANDEJA EMPALME-4");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("N" . $inicio_tf . ":P" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("N" . $inicio_tf, "BANDEJA EMPALME-5");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("Q" . $inicio_tf . ":S" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("Q" . $inicio_tf, "BANDEJA EMPALME-6");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("T" . $inicio_tf . ":V" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("T" . $inicio_tf, "BANDEJA EMPALME-7");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("W" . $inicio_tf . ":Y" . $inicio_tf);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("W" . $inicio_tf, "BANDEJA EMPALME-8");
                                
                    // Bandeja de Conectores
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("B" . ($inicio_tf + 1) . ":D" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("B" . ($inicio_tf + 1), "BANDEJA CONECTORES-1");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("E" . ($inicio_tf + 1) . ":G" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("E" . ($inicio_tf + 1), "BANDEJA CONECTORES-2");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("H" . ($inicio_tf + 1) . ":J" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H" . ($inicio_tf + 1), "BANDEJA CONECTORES-3");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("K" . ($inicio_tf + 1) . ":M" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K" . ($inicio_tf + 1), "BANDEJA CONECTORES-4");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("N" . ($inicio_tf + 1) . ":P" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("N" . ($inicio_tf + 1), "BANDEJA CONECTORES-5");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("Q" . ($inicio_tf + 1) . ":S" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("Q" . ($inicio_tf + 1), "BANDEJA CONECTORES-6");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("T" . ($inicio_tf + 1) . ":V" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("T" . ($inicio_tf + 1), "BANDEJA CONECTORES-7");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("W" . ($inicio_tf + 1) . ":Y" . ($inicio_tf + 1));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("W" . ($inicio_tf + 1), "BANDEJA CONECTORES-8");
                    
                    // Cables, FO y Asignaciones
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A" . ($inicio_tf + 2), "CABLE");
                                       
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("B" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("C" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("D" . ($inicio_tf + 2), "FO");
                                            
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("E" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("F" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("G" . ($inicio_tf + 2), "FO");
                    
                                                           
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("H" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("I" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("J" . ($inicio_tf + 2), "FO");
                    
                                                           
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("K" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("L" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("M" . ($inicio_tf + 2), "FO");
                    
                                                           
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("N" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("O" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("P" . ($inicio_tf + 2), "FO");
                    
                                                           
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("Q" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("R" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("S" . ($inicio_tf + 2), "FO");
                    
                                                           
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("T" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("U" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("V" . ($inicio_tf + 2), "FO");
                    
                                                           
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("W" . ($inicio_tf + 2), "FO");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("X" . ($inicio_tf + 2), "ASIGNACIÓN");
                    
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("Y" . ($inicio_tf + 2), "FO");
                    
                    // Tubos de Fibra
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells("A" . ($inicio_tf + 3) . ":A" . ($inicio_tf + 18));
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A" . ($inicio_tf + 3), $tubofibra["id2"] . ": " . $tubofibra["descripcion"]);
                    
                    // Estilo Cabecera
                    $estilo_cabecera = new PHPExcel_Style();
                    $estilo_cabecera->applyFromArray( array(
                        'font' => array(
                            'name'  => 'TheSansCorrespondence',
                            'color' => array(
                                'rgb' => 'FFFFFF'
                            ),
                            'size' => 10,
                            'bold'      => true,
                            'italic'    => false
                        ),
                        'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                'rgb' => '808080')
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => '000000'),
                            )
                        )
                    ));

                    $estilo_cabecera_2 = new PHPExcel_Style();
                    $estilo_cabecera_2->applyFromArray( array(
                        'font' => array(
                            'name'  => 'TheSansCorrespondence',
                            'color' => array(
                                'rgb' => '000000'
                            ),
                            'size' => 10,
                            'bold'      => true,
                            'italic'    => false
                        ),
                        'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                'rgb' => 'FFFFFF')
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => '000000'),
                            )
                        )
                    ));
                    
                    $estilo_cabecera_be = new PHPExcel_Style();
                    $estilo_cabecera_be->applyFromArray( array(
                        'font' => array(
                            'name'  => 'TheSansCorrespondence',
                            'color' => array(
                                'rgb' => '000000'
                            ),
                            'size' => 10,
                            'bold'      => true,
                            'italic'    => false
                        ),
                        'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                'rgb' => 'D8E4BC')
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => '000000'),
                            )
                        )
                    ));      
                    
                    $estilo_cabecera_bc = new PHPExcel_Style();
                    $estilo_cabecera_bc->applyFromArray( array(
                        'font' => array(
                            'name'  => 'TheSansCorrespondence',
                            'color' => array(
                                'rgb' => '000000'
                            ),
                            'size' => 10,
                            'bold'      => true,
                            'italic'    => false
                        ),
                        'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                'rgb' => 'FFC000')
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => '000000'),
                            )
                        )
                    ));

                    $style = array(
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                        )
                    );

                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera, "A" . $inicio_tf . ":Y" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->getStyle("A" . $inicio_tf)->getAlignment()->setWrapText(true);

                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "B" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "D" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "E" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "G" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "H" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "J" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "K" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "M" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "N" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "P" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "Q" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "S" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "T" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "V" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "W" . ($inicio_tf + 2));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_2, "Y" . ($inicio_tf + 2));
                    
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "B" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "E" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "H" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "K" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "N" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "Q" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "T" . $inicio_tf);
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_be, "W" . $inicio_tf);
                    
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "B" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "E" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "H" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "K" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "N" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "Q" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "T" . ($inicio_tf + 1));
                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cabecera_bc, "W" . ($inicio_tf + 1));
                    
                    $objPHPExcel->getActiveSheet()->getStyle("A" . $inicio_tf . ":Y" . ($inicio_tf + 2))->applyFromArray($style);
                
                    // Estilo A
                    $estilo_cuerpo_A = new PHPExcel_Style();
                    $estilo_cuerpo_A->applyFromArray( array(
                        'font' => array(
                            'name'  => 'TheSansCorrespondence',
                            'color' => array(
                                'rgb' => '000000'
                            ),
                            'size' => 14,
                            'bold'      => true,
                            'italic'    => false
                        ),
                        'fill' => array(
                            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array(
                                'rgb' => 'C4D79B')
                        ),
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array('argb' => '000000'),
                            )
                        )
                    )); 

                    $style = array(
                        'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                        )
                    );

                    $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_A, "A" . ($inicio_tf + 3) . ":A" . ($inicio_tf + 18));
                    $objPHPExcel->getActiveSheet()->getStyle("A" . ($inicio_tf + 3) . ":A" . ($inicio_tf + 18))->applyFromArray($style);
                    $objPHPExcel->getActiveSheet()->getStyle("A" . ($inicio_tf + 3) . ":A" . ($inicio_tf + 18))->getAlignment()->setTextRotation(90);
                        
                    $inicio_be = 66;
                    foreach($tubofibra["Be"] as $be) {
                        $bc = $be["Bc"][0];
                        
                        $inicio_cf = $inicio_tf + 3;
                        $auxiliar = 1;
                                              
                        $estilo_cuerpo_Asignaciones = new PHPExcel_Style();
                        $estilo_cuerpo_Asignaciones->applyFromArray( array(
                            'font' => array(
                                'name'  => 'TheSansCorrespondence',
                                'color' => array(
                                    'rgb' => '000000'
                                ),
                                'size' => 10,
                                'bold'      => false,
                                'italic'    => false
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array('argb' => '000000'),
                                )
                            )
                        )); 
                        $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_Asignaciones, chr($inicio_be + 1) . ($inicio_tf + 3) . ":" . chr($inicio_be + 1) . ($inicio_tf + 18));
                        
                        foreach($bc["Conectorfibra"] as $conector) {
                            if($auxiliar % 2 != 0) {
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->mergeCells(chr($inicio_be) . $inicio_cf . ":" . chr($inicio_be) . ($inicio_cf + 1));
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue(chr($inicio_be) . $inicio_cf, $conector["numeracion"]);
                                
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue(chr($inicio_be + 1) . $inicio_cf, $conector["descripcion"]);
                                
                                $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf)->setRowHeight(30);
                                
                                $celda = chr($inicio_be + 1) . $inicio_cf;
                            } elseif($auxiliar % 2 == 0) {
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->mergeCells(chr($inicio_be + 2) . $inicio_cf . ":" . chr($inicio_be + 2) . ($inicio_cf + 1));
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue(chr($inicio_be + 2) . $inicio_cf, $conector["numeracion"]);
                                
                                $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue(chr($inicio_be + 1) . ($inicio_cf + 1), $conector["descripcion"]);
                                
                                $objPHPExcel->setActiveSheetIndex(0)->getRowDimension($inicio_cf + 1)->setRowHeight(30);
                                
                                $celda = chr($inicio_be + 1) . ($inicio_cf + 1);
                                
                                $inicio_cf += 2;
                            }
                            
                            $objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($tipo[$conector["tipos_id"]]);              
                            if($conector["tipos_id"] != 1) {
                                //Comentario
                                $objPHPExcel->getActiveSheet()->getComment($celda)->setAuthor('Sistema-ODF');
                                $objPHPExcel->getActiveSheet()->getComment($celda)->setHeight(350);
                                $objPHPExcel->getActiveSheet()->getComment($celda)->setWidth(200);

                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Numeraciòn: ' . $conector["numeracion"]);
                                $objCommentRichText->getFont()->setBold(true); 
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Intermedio:');
                                $objCommentRichText->getFont()->setBold(true); 
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["intermedio"]) ? $conector["intermedio"] : " ");  
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");                             

                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Gestor:');
                                $objCommentRichText->getFont()->setBold(true); 
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun($conector["Gestor"]["descripcion"]);
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Ubicación del Gestor:');
                                $objCommentRichText->getFont()->setBold(true); 
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["gestor_ubicacion"]) ? $conector["gestor_ubicacion"] : " ");
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");

                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun('Observación:');
                                $objCommentRichText->getFont()->setBold(true); 
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun(!empty($conector["observacion"]) ? $conector["observacion"] : " ");
                                $objCommentRichText = $objPHPExcel->getActiveSheet()->getComment($celda)->getText()->createTextRun("\r\n");
                            }
                                
                            $auxiliar += 1;
                        }
                        // Estilo B, D, E, G, H, J, K, M, N, P, Q, S, T, V, W, Y
                        $estilo_cuerpo_B_D_E_G_H_J_K_M_N_P_Q_S_T_V_W_Y = new PHPExcel_Style();
                        $estilo_cuerpo_B_D_E_G_H_J_K_M_N_P_Q_S_T_V_W_Y->applyFromArray( array(
                            'font' => array(
                                'name'  => 'TheSansCorrespondence',
                                'color' => array(
                                    'rgb' => '000000'
                                ),
                                'size' => 10,
                                'bold'      => false,
                                'italic'    => false
                            ),
                            'fill' => array(
                                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array(
                                    'rgb' => 'D9D9D9')
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array('argb' => '000000'),
                                )
                            )
                        )); 
                      
                        $style = array(
                            'alignment' => array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                            )
                        );

                        $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_B_D_E_G_H_J_K_M_N_P_Q_S_T_V_W_Y, chr($inicio_be) . ($inicio_tf + 3) . ":" . chr($inicio_be) . ($inicio_tf + 18));
                        $objPHPExcel->getActiveSheet()->setSharedStyle($estilo_cuerpo_B_D_E_G_H_J_K_M_N_P_Q_S_T_V_W_Y, chr($inicio_be + 2) . ($inicio_tf + 3) . ":" . chr($inicio_be + 2) . ($inicio_tf + 18));
                        
                        $objPHPExcel->getActiveSheet()->getStyle(chr($inicio_be) . ($inicio_tf + 3) . ":" . chr($inicio_be) . ($inicio_tf + 18))->applyFromArray($style);
                        $objPHPExcel->getActiveSheet()->getStyle(chr($inicio_be + 1) . ($inicio_tf + 3) . ":" . chr($inicio_be + 1) . ($inicio_tf + 18))->applyFromArray($style);
                        $objPHPExcel->getActiveSheet()->getStyle(chr($inicio_be + 2) . ($inicio_tf + 3) . ":" . chr($inicio_be + 2) . ($inicio_tf + 18))->applyFromArray($style);
                        
                        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(chr($inicio_be))->setWidth(5);
                        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(chr($inicio_be + 1))->setWidth(25);
                        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(chr($inicio_be + 2))->setWidth(5);
                        
                        $inicio_be += 3;
                    }
                    
                    $inicio_tf += 20;
                }
                break;
        }

        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle($odf["Urd"]["descripcion"] . " (" . $odf["Odf"]["numeracion"] . ")");

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,7);
        
        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        $this->response->type("application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        $this->response->cache(0);
        header('Content-Disposition: attachment;filename="Reporte-de-ODF-' . $odf["Urd"]["descripcion"] . ' (' . $odf["Odf"]["numeracion"] . ').xlsx"');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}
