/*!
 * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
 * Copyright 2011-2023 The Bootstrap Authors
 * Licensed under the Creative Commons Attribution 3.0 Unported License.
 */

(() => {
  'use strict'

  const themes = ['light', 'dark', 'auto']
  const colorScheme = window.matchMedia
    ? window.matchMedia('(prefers-color-scheme: dark)')
    : null
  const getStoredTheme = () => {
    try {
      const theme = localStorage.getItem('theme')
      if (themes.includes(theme)) {
        return theme
      }

      const legacyTheme = localStorage.getItem('selectedTheme')
      if (themes.includes(legacyTheme)) {
        localStorage.setItem('theme', legacyTheme)
        localStorage.removeItem('selectedTheme')
        return legacyTheme
      }
    } catch (error) {
      console.warn('Unable to read the saved theme preference.', error)
    }

    return null
  }
  const setStoredTheme = theme => {
    try {
      localStorage.setItem('theme', theme)
      localStorage.removeItem('selectedTheme')
    } catch (error) {
      console.warn('Unable to save the theme preference.', error)
    }
  }

  const getPreferredTheme = () => getStoredTheme() || 'auto'

  const setTheme = theme => {
    const resolvedTheme = theme === 'auto'
      ? (colorScheme && colorScheme.matches ? 'dark' : 'light')
      : theme
    document.documentElement.setAttribute('data-bs-theme', resolvedTheme)
  }

  setTheme(getPreferredTheme())

  const showActiveTheme = (theme, focus = false) => {
    const themeSwitcher = document.querySelector('#bd-theme')

    if (!themeSwitcher) {
      return
    }

    const activeThemeIcon = document.querySelector('.theme-icon-active use')
    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
    const activeButtonIcon = btnToActive && btnToActive.querySelector('svg use')

    if (!btnToActive) {
      return
    }

    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
      element.classList.remove('active')
      element.setAttribute('aria-pressed', 'false')
    })

    btnToActive.classList.add('active')
    btnToActive.setAttribute('aria-pressed', 'true')
    if (activeThemeIcon && activeButtonIcon) {
      const iconHref = activeButtonIcon.getAttribute('href') || activeButtonIcon.getAttribute('xlink:href')
      if (iconHref) {
        activeThemeIcon.setAttribute('href', iconHref)
      }
    }
    const themeSwitcherText = document.querySelector('#bd-theme-text')
    const themeSwitcherLabel = `${themeSwitcherText ? themeSwitcherText.textContent : 'Toggle theme'} (${theme})`
    themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

    if (focus) {
      themeSwitcher.focus()
    }
  }

  const handleColorSchemeChange = () => {
    if (getPreferredTheme() === 'auto') {
      setTheme(getPreferredTheme())
    }
  }
  if (colorScheme && colorScheme.addEventListener) {
    colorScheme.addEventListener('change', handleColorSchemeChange)
  } else if (colorScheme && colorScheme.addListener) {
    colorScheme.addListener(handleColorSchemeChange)
  }

  window.addEventListener('DOMContentLoaded', () => {
    showActiveTheme(getPreferredTheme())

    document.querySelectorAll('[data-bs-theme-value]')
      .forEach(toggle => {
        toggle.addEventListener('click', () => {
          const theme = toggle.getAttribute('data-bs-theme-value')
          if (!themes.includes(theme)) {
            return
          }
          setStoredTheme(theme)
          setTheme(theme)
          showActiveTheme(theme, true)
        })
      })
  })
})()
