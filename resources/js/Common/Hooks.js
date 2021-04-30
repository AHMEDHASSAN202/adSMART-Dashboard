class Hooks {

    //Registered actions
    // static actions = {};

    /**
     * Add a new Action callback to Hooks.actions
     *
     * @param tag The tag specified by do_action()
     * @param callback The callback function to call when do_action() is called
     * @param priority The order in which to call the callbacks. Default: 10 (like WordPress)
     */
    static add_action(tag, callback) {
        Hooks.actions[tag] = Hooks.actions[tag] || []
        Hooks.actions[tag].push(callback);
    }

    /**
     * Remove an Anction callback from Hooks.actions
     *
     * Must be the exact same callback signature.
     * Warning: Anonymous functions can not be removed.
     * @param tag The tag specified by do_action()
     * @param callback The callback function to remove
     */
    static remove_action(tag, callback) {
        Hooks.actions[tag] = Hooks.actions[tag] || [];
        let index = Hooks.actions[tag].indexOf(callback)
        Hooks.actions[tag].splice(index, 1);
    }

    /**
     * Calls actions that are stored in Hooks.actions for a specific tag or nothing
     * if there are no actions to call.
     *
     * @param tag A registered tag in Hook.actions
     * @params Params JavaScript array to pass to the callbacks
     */
    static do_action(tag, ...params) {
        if (
            typeof Hooks.actions[tag] == 'undefined' ||
            Hooks.actions[tag].length == 0)
        {
            return null;
        }
        let r = true;
        Hooks.actions[tag].forEach(callback => {
            if (callback(...params) === false) r = false;
        });
        return r;
    }
}

Hooks.actions = {};

export default Hooks;
