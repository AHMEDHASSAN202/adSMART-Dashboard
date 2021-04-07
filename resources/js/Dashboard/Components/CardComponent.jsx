import {useState, useEffect, useRef} from "react";

const CardComponent = ({title, subtitle, children, footer, icon, tabs=[]}) => {
    const [activeLink, setActiveLink] = useState(tabs[0] || {});
    const tabElement = useRef(null)

    useEffect(() => {
        if (!tabElement.current) return;
        let nodes = tabElement.current.childNodes;
        nodes.forEach((node) => {
            if (node.getAttribute('id') == activeLink.id) {
                node.classList.add('active', 'show');
            }else {
                node.classList.remove('active', 'show');
            }
        })
    }, [activeLink])

    return (
        <div className="card card-custom mb-4">
            {title ?
                <div className={'card-header ' + (tabs.length ? 'card-header-tabs-line' : '')}>
                    <div className="card-title">
                        {icon ? <span className="card-icon">
                        <i className={icon}></i>
                    </span> : ''}
                        <h3 className="card-label">
                            {title}
                            {subtitle ? <small>{subtitle}</small> : ''}
                        </h3>
                    </div>
                    {tabs.length ?
                    <div className="card-toolbar">
                        <ul className="nav nav-tabs nav-bold nav-tabs-line" id='nav-tabs'>
                            {tabs.map((tab, key) => (
                                <li className="nav-item" key={key}>
                                    <a className={'cursor-pointer nav-link ' + ((activeLink.id == tab.id) ? 'active' : '')} onClick={() => setActiveLink(tab)} data-toggle="tab">{tab.title}</a>
                                </li>
                            ))}
                        </ul>
                    </div> : ''}
                </div> : ''}
            <div className="card-body">
                {tabs.length ? <div className='tab-content' ref={tabElement}>{children}</div> : children}
            </div>
            {footer ?
                <div className="card-footer d-flex justify-content-between">
                    {footer}
                </div> : ''}
        </div>
    )
}

export default CardComponent;
