import React from "react";
import { InertiaLink } from '@inertiajs/inertia-react'

export default function AsideMenuLi({menu}) {

    if (typeof menu.section != 'undefined') {
        return (
            <li className="menu-section">
                <h4 className="menu-text">{menu.section}</h4>
            </li>
        );
    }
    return (
        <li className={'menu-item ' + menu.extraClasses + ((menu.submenu && menu.submenu.length) ? ' menu-item-submenu ' : '')} aria-haspopup="true">
            <InertiaLink
                href={menu.page}
                className='menu-link'
            >
                <i className={'menu-icon '+ menu.icon}></i>
                <span className="menu-text">{menu.title}</span>
                {menu.submenu && menu.submenu.length ? <i className="menu-arrow"></i> : ''}
            </InertiaLink>
            {
                menu.submenu && menu.submenu.length ?
                    (
                        <div className="menu-submenu">
                            <i className="menu-arrow"></i>
                            <ul className="menu-subnav">
                                {menu.submenu.map((m, i) => (
                                    <AsideMenuLi menu={m} key={i}/>
                                ))}
                            </ul>
                        </div>
                    )
                    : ''
            }
        </li>
    );
}
