<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2013-2017  Carlos Garcia Gomez  carlos@facturascripts.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Core\Controller;

use FacturaScripts\Core\Base\ExtendedController;

/**
 * Controlador para la lista de clientes
 *
 * @author Carlos García Gómez <carlos@facturascripts.com>
 * @author Artex Trading sa <jcuello@artextrading.com>
 */
class ListCliente extends ExtendedController\ListController
{
    public function getPageData()
    {
        $pagedata = parent::getPageData();
        $pagedata['title'] = 'customers';
        $pagedata['icon'] = 'fa-users';
        $pagedata['menu'] = 'sales';

        return $pagedata;
    }

    protected function createViews()
    {
        /* Clientes */
        $this->addView('FacturaScripts\Core\Model\Cliente', 'ListCliente', $this->i18n->trans('customers'));
        $this->addSearchFields('ListCliente', ['nombre', 'razonsocial', 'codcliente', 'email']);

        $this->addOrderBy('ListCliente', 'codcliente', $this->i18n->trans('code'));
        $this->addOrderBy('ListCliente', 'nombre', $this->i18n->trans('name'), 1);
        $this->addOrderBy('ListCliente', 'fecha', $this->i18n->trans('date'));

        $this->addFilterSelect('ListCliente', 'codgrupo', 'gruposclientes', '', $this->i18n->trans('nombre'));
        $this->addFilterCheckbox('ListCliente', 'debaja', $this->i18n->trans('suspended'));
        
        /* Grupos */
        $this->addView('FacturaScripts\Core\Model\GrupoClientes', 'ListGrupoClientes', $this->i18n->trans('groups'));
        $this->addSearchFields('ListGrupoClientes', ['nombre', 'codgrupo']);
        
        $this->addOrderBy('ListGrupoClientes', 'codgrupo', $this->i18n->trans('code'));
        $this->addOrderBy('ListGrupoClientes', 'nombre', $this->i18n->trans('name'), 1);
    }
}
