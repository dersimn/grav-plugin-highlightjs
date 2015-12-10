# Grav HighlightJS Plugin 

This is a quick implementation of [HighlightJS](http://highlightjs.org) for the [Grav](http://github.com/getgrav/grav) CMS.

HighlightJS includes a few languages by default, see the official [download page](http://highlightjs.org/download) for a list. If you need to use additional languages, you can add them to the `languages` array in `highlightjs.yaml`. For e.g. to add support for TeX and Swift, you would add:

	languages:
	  - tex
	  - swift

See [CDN](https://cdnjs.com/libraries/highlight.js) for a list of available languages.

## Install 

1) Clone the repository to your `plugins` folder

	git clone http://github.com/dersimn/grav-plugin-highlightjs highlightjs

2) Activate the plugin by copying `highlightjs.yaml` containing the default settings to your config folder

	cp highlightjs/highlightjs.yaml ../config/plugins

## License

Highlight.js is released under the BSD License. I'm therefore releasing my plugin under BSD License as well.