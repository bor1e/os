<h1>{{ LaravelLocalization::getCurrentLocale() }}</h1>


<br>
<br>
{{ __('test.hello') }}


@isset($name)
{{ __('test.dear', ['name' => $name]) }}
@endisset
<ul>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <!--
      /**
       * Returns an URL adapted to $locale
       *
       * @ param  string|boolean 	$locale	   	Locale to adapt, false to remove locale
       * @ param  string|false		$url		URL to adapt in the current language. If not passed, the current url would be taken.
       * @ param  array 		$attributes	Attributes to add to the route, if empty, the system would try to extract them from the url.
       *
      -->
        <li>
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, []) }}">
                {{ $properties['native'] }}
            </a>
        </li>
    @endforeach
</ul>
