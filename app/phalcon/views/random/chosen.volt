{{ content() }}

<div class="row">
        <div class="well text-center">
            <h3>Millipede</h3>
            <h5>Here is Millipede for next 2 weeks</h5>
            <p id="millipede">{{ emailMessage }}</p>
            <div class="" id="email-confirmation">
                <h4>
                    {% if emailsSent %}
                        <p>Emails was sent to {{ emailsSent }}.</p>
                    {% elseif emailsNotSent %}
                        <p>Emails wasn't sent to {{ emailsNotSent }}.</p>
                        <h6>Contact with administrator.</h6>
                    {% endif %}
                </h4>
            </div>
        </div>
</div>