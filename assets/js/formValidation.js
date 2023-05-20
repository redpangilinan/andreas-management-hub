const validateForm = (formId) => {
    const form = document.querySelector(formId);
    const inputs = form.getElementsByTagName('input');

    for (let i = 0; i < inputs.length; i++) {
        const value = inputs[i].value.trim();

        if (value === '') {
            return false;
        }
    }

    return true;
};
