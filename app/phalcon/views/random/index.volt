{{ content() }}

<div class="row">
    <div>
        <div class="well">
            <h3>Amount of Developers</h3>
            <p>Please enter developers data</p>
            {{ form('action': 'random/chosen', 'class': 'form-search') }}
            {% for dev in amount %}
                <div>
                    {{ form.label('email') }}
                    {{ form.render('email', ['name' : 'email_' ~ dev]) }}
                    {{ form.label('project') }}
                    {{ form.render('project', ['name' : 'project_' ~ dev]) }}
                    {{ form.label('function') }}
                    {{ form.render('function', ['name' : 'function_' ~ dev]) }}
                </div>
            {% endfor %}
            {{ form.render('Choose') }}
            </form>
            </div>
        </div>
    </div>
</div>