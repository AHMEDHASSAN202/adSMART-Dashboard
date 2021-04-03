
const CardTab = ({id, children}) => {
    return (
        <div className="tab-pane fade" id={id} role="tabpanel">
            {children}
        </div>
    )
}

export default CardTab;
