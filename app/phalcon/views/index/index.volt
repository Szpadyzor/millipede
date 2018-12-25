{{ content() }}

<header id="overview">
    <div class="hero-unit">
        <h1>Welcome!</h1>
        <p class="lead">This is a website to randomly choose Code Review queue - Millipede!</p>
    </div>
</header>

<div class="row">
    <div>
        <div class="well">
            <h3>Amount of Developers</h3>
            <p>Please enter a number of developers for Millipede</p>
            {{ form('action': 'random', 'class': 'form-search') }}
                {{ form.render('amount') }}
                {{ form.messages('amount') }}
                {{ form.render('Confirm') }}
            </form>
            </div>
        </div>
    </div>

    <div>
        <h3>Contact</h3>
        <address>
            <strong>Trysoft Maciej Trybuła</strong><br>
            Pomorska 6/1, 50-218 Wrocław<br>
            <abbr title="Phone">P:</abbr> (+48) 792889188
        </address>
        <address>
            <strong>Maciej Trybuła</strong><br>
            <a href="mailto:#">maciej.trybula@gmail.com</a>
        </address>
    </div>
</div>