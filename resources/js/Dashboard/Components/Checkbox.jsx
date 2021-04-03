
const Checkbox = ({checked=0, label='', ...props}) => {
    return (
        <label className="checkbox checkbox-outline checkbox-dark">
            <input type="checkbox" {...props} checked={checked} value={checked ? 1 : 0}/>
            <span></span>
            {label}
        </label>
    );
}

export default Checkbox;
