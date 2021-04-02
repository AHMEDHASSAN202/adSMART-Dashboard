import Select from 'react-select'

const SelectComponent = (props) => {
    return (
        <Select {...props} isRtl={(window.currentLanguage.language_direction === 'rtl')} theme={theme => ({
                ...theme,
                colors: {
                    ...theme.colors,
                    primary: '#8950FC',
                    primary25: '#E4E6EF'
                }})}
            />
    );
}

export default SelectComponent;
