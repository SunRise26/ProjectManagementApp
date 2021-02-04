window.FormErrorsHandler = (form_id) => {
    const form = $(`#${form_id}`);

    const prepareErrorBox = (input_name) => (`<div class="error-box" id="${input_name}-error"></div>`);
    const prepareErrorBoxText = (error_id, text) => (`<span class="error-text">${error_id + 1}: ${text}</span>`);
    const processErrors = (input_name, errors) => {
        const inputElement = $(`[name="${input_name}"]`);
        inputElement.after(prepareErrorBox(input_name));
        const errorBox = form.find(`#${input_name}-error`);

        errors.forEach((text, id) => {
            errorBox.append(prepareErrorBoxText(id, text));
        });
    };

    form.find('.input').on('change keydown paste input', (e) => {
        const input = $(e.target);

        input.parent().find('.error-box').remove();
    })

    return {
        setErrors: (errors) => {
            for (const [inputName, values] of Object.entries(errors)) {
                processErrors(inputName, values);
            }
        },
        crearAll: () => {
            form.find('.error-box').remove();
        }
    };
};
