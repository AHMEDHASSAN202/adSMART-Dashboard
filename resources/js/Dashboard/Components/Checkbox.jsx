
const Checkbox = ({checked, ...props}) => {
    return (
        <label className="checkbox checkbox-outline checkbox-dark">
            <input type="checkbox" {...props} checked={checked} value={checked ? 1 : 0}/>
            <span></span>
        </label>
    );
}

export default Checkbox;
