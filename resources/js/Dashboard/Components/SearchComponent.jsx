import {useState, useEffect, useRef} from 'react';
import {Inertia} from "@inertiajs/inertia";
import debounce from 'lodash.debounce';

const SearchComponent = ({data, columns, setDataFunction, originalData, paginationServer, queries}) => {
    const [text, setText] = useState(queries?.s || '');
    const searchInput = useRef()

    useEffect(() => {
        if (queries.s) {
            searchInput.current.focus();
        }
        return () => handleSearchWithDebounce.cancel()
    }, [])

    const handleSearchWithDebounce = debounce((value) => {
        setText(value)
        if (!paginationServer) {
            //client search
            if (value.trim() == '') {
                return setDataFunction(originalData);
            }
            const newData = originalData.filter((d) => {
                let s = false;
                columns.forEach((c) => {
                    if (d[c.selector] && (typeof d[c.selector]) == 'string' && d[c.selector].toLowerCase().includes(value.toLowerCase())) {
                        s = true;
                    }
                })
                return s;
            })
            setDataFunction(newData);
        }else {
            //server search
            Inertia.get(originalData.path, {s: value})
        }
    }, 100);

    const handleChange = (e) => {
        handleSearchWithDebounce(e.target.value);
    }

    return (
        <div>
            <input
                ref={searchInput}
                className={'form-control'}
                type="text"
                value={text}
                onChange={handleChange}
                placeholder={translations['search']+'...'}
            />
        </div>
    );
}

export default SearchComponent;
