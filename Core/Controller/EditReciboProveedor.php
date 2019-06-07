<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2019 Carlos Garcia Gomez <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Core\Controller;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;
use FacturaScripts\Core\Lib\ExtendedController\BaseView;
use FacturaScripts\Core\Lib\ExtendedController\EditController;

/**
 * Description of EditReciboProveedor
 *
 * @author Carlos Garcia Gomez <carlos@facturascripts.com>
 */
class EditReciboProveedor extends EditController
{

    /**
     * 
     * @return string
     */
    public function getModelClassName()
    {
        return 'ReciboProveedor';
    }

    /**
     * 
     * @return array
     */
    public function getPageData()
    {
        $data = parent::getPageData();
        $data['menu'] = 'purchases';
        $data['title'] = 'receipt';
        $data['icon'] = 'fas fa-piggy-bank';
        return $data;
    }

    protected function createViews()
    {
        parent::createViews();
        $this->setTabsPosition('bottom');

        $this->addListView('EditPagoProveedor', 'PagoProveedor', 'payments');
        $this->setSettings('EditPagoProveedor', 'btnNew', false);
        $this->setSettings('EditPagoProveedor', 'btnDelete', false);
    }

    /**
     * 
     * @param string   $viewName
     * @param BaseView $view
     */
    protected function loadData($viewName, $view)
    {
        switch ($viewName) {
            case 'EditPagoProveedor':
                $idrecibo = $this->getViewModelValue('EditReciboProveedor', 'idrecibo');
                $where = [new DataBaseWhere('idrecibo', $idrecibo)];
                $this->views[$viewName]->loadData('', $where, ['idpago' => 'DESC']);
                break;

            case 'EditReciboProveedor':
                parent::loadData($viewName, $view);
                $this->views[$viewName]->model->nick = $this->user->nick;
                break;
        }
    }
}