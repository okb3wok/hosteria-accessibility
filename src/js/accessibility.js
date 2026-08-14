import handleFocusTrap from './focusTrap.js';

const accessibility = {

  defaults: {
    theme: 'norm',
    fontSize: 100,
    font: 'sans',
    kerning: 0,
    lineHeight: 'normal',
    hideImages: false
  },

  state: {
    theme: 'norm',
    fontSize: 100,
    font: 'sans',
    kerning: 0,
    lineHeight: 'normal',
    hideImages: false,
    isOpen: false
  },

  storeKey: undefined,

  init() {
    const prefix = process.env.PREFIX || "store";
    const version = process.env.VERSION || "1.0";
    this.storeKey = `${prefix}_v${version.replaceAll('.', '_')}`;

    const saved = localStorage.getItem(this.storeKey);
    if (saved) {
      try { this.state = { ...this.state, ...JSON.parse(saved) }; } catch(e){}
    }

    if (this.state.lineHeight !== 'normal' && typeof this.state.lineHeight !== 'number') {
      const parsed = parseFloat(this.state.lineHeight);
      this.state.lineHeight = isNaN(parsed) ? 'normal' : parsed;
    }
    if (typeof this.state.kerning !== 'number') {
      this.state.kerning = parseFloat(this.state.kerning) || 0;
    }

    const hosta11yContainer =  document.getElementById('hosta11y-container');

    hosta11yContainer.addEventListener('keydown', event => {
      const trapResult = handleFocusTrap(hosta11yContainer, event);

      if (trapResult === 'close') {
        this.togglePanel();
      }
    })
    this.initResetBtn();



    const themes = ['norm', 'b', 'ch', 'g', 'k'];
    themes.forEach(t => {
      const btn = document.getElementById(`hosta11y-btn-theme-${t}`);
      if (btn) btn.addEventListener('click', () => this.setTheme(t));
    });


    document.getElementById('hosta11y-btn-font-size-dec')?.addEventListener('click', () => this.changeFontSize(-4));
    document.getElementById('hosta11y-btn-font-size-inc')?.addEventListener('click', () => this.changeFontSize(4));


    document.getElementById('hosta11y-btn-font-sans')?.addEventListener('click', () => this.setFont('sans'));
    document.getElementById('hosta11y-btn-font-serif')?.addEventListener('click', () => this.setFont('serif'));


    document.getElementById('hosta11y-btn-kerning-dec')?.addEventListener('click', () => this.changeKerning(-0.05));
    document.getElementById('hosta11y-btn-kerning-inc')?.addEventListener('click', () => this.changeKerning(0.05));


    document.getElementById('hosta11y-btn-line-height-dec')?.addEventListener('click', () => this.changeLineHeight(-0.2));
    document.getElementById('hosta11y-btn-line-height-inc')?.addEventListener('click', () => this.changeLineHeight(0.2));

    // Изображения
    document.getElementById('hosta11y-btn-toggle-img')?.addEventListener('click', () => this.toggleImages());

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape' && this.state.isOpen) {
        this.togglePanel();
      }
    });

    const triggerId = (typeof hosta11yConfig !== 'undefined' && hosta11yConfig.triggerId)
      ? hosta11yConfig.triggerId
      : 'hosta11y-toggle-btn';

    const toggleBtn = document.getElementById(triggerId);

    if (toggleBtn) {
      toggleBtn.addEventListener('click', (e) => {
        e.preventDefault();
        this.togglePanel();
      });
    }

    document.addEventListener('click', (event) => {
      const panel = document.getElementById('hosta11y-panel');
      if (!panel) return;

      const isClickInsidePanel = panel.contains(event.target);
      const isClickOnToggleBtn = toggleBtn && toggleBtn.contains(event.target);

      if (!isClickInsidePanel && !isClickOnToggleBtn && this.state.isOpen) {
        this.togglePanel();
      }
    });

    this.apply();
  },

  // Генерация плашки вверху страницы
  initResetBtn() {
    const btn = document.getElementById("hosta11y-top-reset-btn");
    if (btn) {
      btn.addEventListener("click", () => this.resetToDefault());
    }
  },

  // Проверка: изменены ли настройки от исходных
  isModified() {
    return (
      this.state.theme !== this.defaults.theme ||
      this.state.fontSize !== this.defaults.fontSize ||
      this.state.font !== this.defaults.font ||
      this.state.kerning !== this.defaults.kerning ||
      this.state.lineHeight !== this.defaults.lineHeight ||
      this.state.hideImages !== this.defaults.hideImages
    );
  },

  // Сброс к дефолту
  resetToDefault() {
    this.state = {
      ...this.defaults,
      isOpen: this.state.isOpen
    };
    this.save();
  },

  togglePanel() {
    this.state.isOpen = !this.state.isOpen;
    this.save();
    const panel = document.getElementById('hosta11y-panel');
    panel.classList.toggle('hosta11y-hidden');
    const firstBtn = panel.querySelector('button');
    if (firstBtn) firstBtn.focus();
    const toggleBtn = document.getElementById('hosta11y-toggle-btn');
    const toggleBtnIcons = document.querySelectorAll('.hosta11y-toggle-icon');
    console.log(this.state.isOpen)
    if (this.state.isOpen) {
      toggleBtn.classList.add('hosta11y-toggle-btn__opened');
      panel.classList.add('hosta11y-panel__opened');
      toggleBtnIcons[0].classList.add('hosta11y-toggle-icon__hidden');
      toggleBtnIcons[1].classList.remove('hosta11y-toggle-icon__hidden');
    }
    else{
      toggleBtn.classList.remove('hosta11y-toggle-btn__opened');
      panel.classList.remove('hosta11y-panel__opened');
      toggleBtnIcons[0].classList.remove('hosta11y-toggle-icon__hidden');
      toggleBtnIcons[1].classList.add('hosta11y-toggle-icon__hidden');
    }
  },

  save() {
    localStorage.setItem(this.storeKey, JSON.stringify(this.state));
    this.apply();
  },

  setTheme(theme) {
    if (theme === 'norm') {
      this.resetToDefault();
    } else {
      this.state.theme = theme;
      this.save();
    }
  },

  changeFontSize(delta) {
    this.state.fontSize = Math.max(70, Math.min(200, this.state.fontSize + delta));
    this.save();
  },

  setFont(font) {
    this.state.font = font;
    this.save();
  },

  changeKerning(delta) {
    const current = parseFloat(this.state.kerning) || 0;
    const newVal = parseFloat((current + delta).toFixed(2));
    this.state.kerning = Math.max(0, Math.min(0.5, newVal));
    this.save();
  },

  changeLineHeight(delta) {
    const base = 1.5;
    const current = this.state.lineHeight === 'normal' ? base : parseFloat(this.state.lineHeight);
    const newVal = parseFloat((current + delta).toFixed(1));
    this.state.lineHeight = Math.max(1.0, Math.min(3.0, newVal));
    this.save();
  },

  toggleImages() {
    this.state.hideImages = !this.state.hideImages;
    this.save();
  },

  highlightActiveButtons() {
    document.querySelectorAll('#hosta11y-panel .hosta11y-btn').forEach(btn => {
      btn.classList.remove('hosta11y-btn-active');
    });

    const activeThemeBtn = document.getElementById(`hosta11y-btn-theme-${this.state.theme}`);
    if (activeThemeBtn) activeThemeBtn.classList.add('hosta11y-btn-active');

    const activeFontBtn = document.getElementById(`hosta11y-btn-font-${this.state.font}`);
    if (activeFontBtn) activeFontBtn.classList.add('hosta11y-btn-active');

    if (this.state.hideImages) {
      const imgBtn = document.getElementById('hosta11y-btn-toggle-img');
      if (imgBtn) imgBtn.classList.add('hosta11y-btn-active');
    }
  },

  apply() {
    const html = document.documentElement;

    // 1. Темы
    html.classList.remove('hosta11y-theme-norm', 'hosta11y-theme-b', 'hosta11y-theme-ch', 'hosta11y-theme-g', 'hosta11y-theme-k');
    html.classList.add('hosta11y-theme-' + this.state.theme);

    // 2. Размер шрифта
    if (this.state.fontSize === 100) {
      html.classList.remove('hosta11y-custom-font-size');
      html.style.removeProperty('--hosta11y-font-scale');
    } else {
      const scale = this.state.fontSize / 100;
      html.classList.add('hosta11y-custom-font-size');
      html.style.setProperty('--hosta11y-font-scale', scale);
    }

    // 3. Шрифт
    html.classList.remove('hosta11y-font-serif', 'hosta11y-font-sans');
    html.classList.add('hosta11y-font-' + this.state.font);

    // 4. Кернинг
    if (this.state.kerning === 0) {
      html.style.removeProperty('--hosta11y-letter-spacing');
    } else {
      html.style.setProperty('--hosta11y-letter-spacing', this.state.kerning + 'em');
    }

    // 5. Межстрочный интервал
    if (this.state.lineHeight === 'normal') {
      html.classList.remove('hosta11y-custom-line-height');
      html.style.removeProperty('--hosta11y-line-height');
    } else {
      html.classList.add('hosta11y-custom-line-height');
      html.style.setProperty('--hosta11y-line-height', this.state.lineHeight);
    }

    // 6. Скрытие фото
    html.classList.toggle('hosta11y-hide-images', this.state.hideImages);

    // 7. Обновление плашки "Back to Normal"
    const topResetBtn = document.getElementById('hosta11y-top-reset-btn');
    if (topResetBtn) {
      topResetBtn.classList.toggle('hosta11y-active', this.isModified());
    }

    // 8. Обводка активных кнопок
    this.highlightActiveButtons();
  }
}

export default accessibility;