<template>
    <nav id="main-nav">
        <ul>
            <li><RouterLink :to="{name: 'Index', params: {locale: $i18n.locale}}">{{ $t('mainmenu.index') }}</RouterLink></li>
            <li><RouterLink :to="{name: 'Categories', params: {locale: $i18n.locale}}">{{ $t('mainmenu.categories') }}</RouterLink></li>
            <li><RouterLink :to="{name: 'About', params: {locale: $i18n.locale}}">{{ $t('mainmenu.about') }}</RouterLink></li>
            <li><a href="/admin">{{ $t("mainmenu.admin") }}</a></li>
        </ul>
    </nav>
</template>

<style>
    #main-nav ul {
        background-color: var(--scheme-color-border);
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        align-items: flex-start;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    #main-nav ul li {
        padding: 0 0.5em;
    }
    #main-nav ul li a {
        padding: 1em;
        display: block;
    }
    #main-nav ul li a.router-link-active {
        color: var(--scheme-color-text);
        font-weight: 700;
    }
</style>
