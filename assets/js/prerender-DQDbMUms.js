import '@astrojs/internal-helpers/path';
import { l as lookup, i as isRemoteImage, a as isESMImportedImage, b as isLocalService, D as DEFAULT_HASH_PROPS } from './astro/assets-service-BbuOwTZP.js';
import { A as AstroError, b as ExpectedImageOptions, E as ExpectedImage, F as FailedToFetchRemoteImageDimensions, c as InvalidImageService, d as createAstro, e as createComponent, f as ImageMissingAlt, r as renderTemplate, m as maybeRenderHead, g as addAttribute, s as spreadAttributes, h as renderSlot, i as renderComponent, u as unescapeHTML, j as Fragment, k as renderHead } from './astro-railwr9B.js';
import 'kleur/colors';
/* empty css                          */
/* empty css                            */
/* empty css                              */
import 'clsx';
/* empty css                                     */
/* empty css                              */
/* empty css                            */
/* empty css                          */
import { getIconData, iconToSVG } from '@iconify/utils';
/* empty css                        */

async function probe(url) {
  const response = await fetch(url);
  if (!response.body || !response.ok) {
    throw new Error("Failed to fetch image");
  }
  const reader = response.body.getReader();
  let done, value;
  let accumulatedChunks = new Uint8Array();
  while (!done) {
    const readResult = await reader.read();
    done = readResult.done;
    if (done)
      break;
    if (readResult.value) {
      value = readResult.value;
      let tmp = new Uint8Array(accumulatedChunks.length + value.length);
      tmp.set(accumulatedChunks, 0);
      tmp.set(value, accumulatedChunks.length);
      accumulatedChunks = tmp;
      try {
        const dimensions = lookup(accumulatedChunks);
        if (dimensions) {
          await reader.cancel();
          return dimensions;
        }
      } catch (error) {
      }
    }
  }
  throw new Error("Failed to parse the size");
}

async function getConfiguredImageService() {
  if (!globalThis?.astroAsset?.imageService) {
    const { default: service } = await import(
      // @ts-expect-error
      './astro/assets-service-BbuOwTZP.js'
    ).then(n => n.s).catch((e) => {
      const error = new AstroError(InvalidImageService);
      error.cause = e;
      throw error;
    });
    if (!globalThis.astroAsset)
      globalThis.astroAsset = {};
    globalThis.astroAsset.imageService = service;
    return service;
  }
  return globalThis.astroAsset.imageService;
}
async function getImage$1(options, imageConfig) {
  if (!options || typeof options !== "object") {
    throw new AstroError({
      ...ExpectedImageOptions,
      message: ExpectedImageOptions.message(JSON.stringify(options))
    });
  }
  if (typeof options.src === "undefined") {
    throw new AstroError({
      ...ExpectedImage,
      message: ExpectedImage.message(
        options.src,
        "undefined",
        JSON.stringify(options)
      )
    });
  }
  const service = await getConfiguredImageService();
  const resolvedOptions = {
    ...options,
    src: typeof options.src === "object" && "then" in options.src ? (await options.src).default ?? await options.src : options.src
  };
  if (options.inferSize && isRemoteImage(resolvedOptions.src)) {
    try {
      const result = await probe(resolvedOptions.src);
      resolvedOptions.width ??= result.width;
      resolvedOptions.height ??= result.height;
      delete resolvedOptions.inferSize;
    } catch {
      throw new AstroError({
        ...FailedToFetchRemoteImageDimensions,
        message: FailedToFetchRemoteImageDimensions.message(resolvedOptions.src)
      });
    }
  }
  const originalPath = isESMImportedImage(resolvedOptions.src) ? resolvedOptions.src.fsPath : resolvedOptions.src;
  const clonedSrc = isESMImportedImage(resolvedOptions.src) ? (
    // @ts-expect-error - clone is a private, hidden prop
    resolvedOptions.src.clone ?? resolvedOptions.src
  ) : resolvedOptions.src;
  resolvedOptions.src = clonedSrc;
  const validatedOptions = service.validateOptions ? await service.validateOptions(resolvedOptions, imageConfig) : resolvedOptions;
  const srcSetTransforms = service.getSrcSet ? await service.getSrcSet(validatedOptions, imageConfig) : [];
  let imageURL = await service.getURL(validatedOptions, imageConfig);
  let srcSets = await Promise.all(
    srcSetTransforms.map(async (srcSet) => ({
      transform: srcSet.transform,
      url: await service.getURL(srcSet.transform, imageConfig),
      descriptor: srcSet.descriptor,
      attributes: srcSet.attributes
    }))
  );
  if (isLocalService(service) && globalThis.astroAsset.addStaticImage && !(isRemoteImage(validatedOptions.src) && imageURL === validatedOptions.src)) {
    const propsToHash = service.propertiesToHash ?? DEFAULT_HASH_PROPS;
    imageURL = globalThis.astroAsset.addStaticImage(validatedOptions, propsToHash, originalPath);
    srcSets = srcSetTransforms.map((srcSet) => ({
      transform: srcSet.transform,
      url: globalThis.astroAsset.addStaticImage(srcSet.transform, propsToHash, originalPath),
      descriptor: srcSet.descriptor,
      attributes: srcSet.attributes
    }));
  }
  return {
    rawOptions: resolvedOptions,
    options: validatedOptions,
    src: imageURL,
    srcSet: {
      values: srcSets,
      attribute: srcSets.map((srcSet) => `${srcSet.url} ${srcSet.descriptor}`).join(", ")
    },
    attributes: service.getHTMLAttributes !== void 0 ? await service.getHTMLAttributes(validatedOptions, imageConfig) : {}
  };
}

const $$Astro$I = createAstro();
const $$Image = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$I, $$props, $$slots);
  Astro2.self = $$Image;
  const props = Astro2.props;
  if (props.alt === void 0 || props.alt === null) {
    throw new AstroError(ImageMissingAlt);
  }
  if (typeof props.width === "string") {
    props.width = parseInt(props.width);
  }
  if (typeof props.height === "string") {
    props.height = parseInt(props.height);
  }
  const image = await getImage(props);
  const additionalAttributes = {};
  if (image.srcSet.values.length > 0) {
    additionalAttributes.srcset = image.srcSet.attribute;
  }
  return renderTemplate`${maybeRenderHead()}<img${addAttribute(image.src, "src")}${spreadAttributes(additionalAttributes)}${spreadAttributes(image.attributes)}>`;
}, "D:/project/version/2/Astro/Asre/node_modules/astro/components/Image.astro", void 0);

const $$Astro$H = createAstro();
const $$Picture = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$H, $$props, $$slots);
  Astro2.self = $$Picture;
  const defaultFormats = ["webp"];
  const defaultFallbackFormat = "png";
  const specialFormatsFallback = ["gif", "svg", "jpg", "jpeg"];
  const { formats = defaultFormats, pictureAttributes = {}, fallbackFormat, ...props } = Astro2.props;
  if (props.alt === void 0 || props.alt === null) {
    throw new AstroError(ImageMissingAlt);
  }
  const optimizedImages = await Promise.all(
    formats.map(
      async (format) => await getImage({ ...props, format, widths: props.widths, densities: props.densities })
    )
  );
  let resultFallbackFormat = fallbackFormat ?? defaultFallbackFormat;
  if (!fallbackFormat && isESMImportedImage(props.src) && specialFormatsFallback.includes(props.src.format)) {
    resultFallbackFormat = props.src.format;
  }
  const fallbackImage = await getImage({
    ...props,
    format: resultFallbackFormat,
    widths: props.widths,
    densities: props.densities
  });
  const imgAdditionalAttributes = {};
  const sourceAdditionalAttributes = {};
  if (props.sizes) {
    sourceAdditionalAttributes.sizes = props.sizes;
  }
  if (fallbackImage.srcSet.values.length > 0) {
    imgAdditionalAttributes.srcset = fallbackImage.srcSet.attribute;
  }
  return renderTemplate`${maybeRenderHead()}<picture${spreadAttributes(pictureAttributes)}> ${Object.entries(optimizedImages).map(([_, image]) => {
    const srcsetAttribute = props.densities || !props.densities && !props.widths ? `${image.src}${image.srcSet.values.length > 0 ? ", " + image.srcSet.attribute : ""}` : image.srcSet.attribute;
    return renderTemplate`<source${addAttribute(srcsetAttribute, "srcset")}${addAttribute("image/" + image.options.format, "type")}${spreadAttributes(sourceAdditionalAttributes)}>`;
  })} <img${addAttribute(fallbackImage.src, "src")}${spreadAttributes(imgAdditionalAttributes)}${spreadAttributes(fallbackImage.attributes)}> </picture>`;
}, "D:/project/version/2/Astro/Asre/node_modules/astro/components/Picture.astro", void 0);

const imageConfig = {"service":{"entrypoint":"astro/assets/services/squoosh","config":{}},"domains":["astro.build"],"remotePatterns":[]};
					const outDir = new URL("file:///D:/project/version/2/Astro/Asre/dist/");
					new URL("assets/images", outDir);
					const getImage = async (options) => await getImage$1(options, imageConfig);

const Logo = new Proxy({"src":"./assets/images/logo-ZIv9wrFv.png","width":736,"height":712,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/Asre/src/assets/images/logo.png";
							}
							globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/Asre/src/assets/images/logo.png");
							return target[name];
						}
					});

const Img = new Proxy({"src":"./assets/images/1-DOxE-mvv.png","width":1456,"height":832,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/Asre/src/assets/slider/1.png";
							}
							globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/Asre/src/assets/slider/1.png");
							return target[name];
						}
					});

const Img_2 = new Proxy({"src":"./assets/images/2-BmDiIgGC.png","width":1500,"height":1122,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/Asre/src/assets/slider/2.png";
							}
							globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/Asre/src/assets/slider/2.png");
							return target[name];
						}
					});

const Img_3 = new Proxy({"src":"./assets/images/3-DIJdARvm.png","width":996,"height":664,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/Asre/src/assets/slider/3.png";
							}
							globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/Asre/src/assets/slider/3.png");
							return target[name];
						}
					});

const HeaderData = [
  {
    title: "الرئيسية",
    path: "/"
  },
  {
    title: "من نحن",
    path: "AboutUs.html"
  },
  {
    title: "المعالم السياحية",
    path: "TouristView.php"
  },
  {
    title: "الجولات السياحية",
    path: "ViewTours.html"
  },
  {
    title: " جدول الرحلات ",
    path: "cart.html"
  }
];
const SwiperData = [
  {
    title: "سنساعدك علي اكتشاف العالم ",
    img: Img,
    des: "اكتشف المعالم الأثرية الأكثر شهرة وتاريخية في العالم مع العجائب الأثرية. انطلق في رحلة عبر الزمن والثقافة بينما نستكشف الهياكل الرائعة التي صمدت أمام اختبار الزمن، وشهدت على النسيج الغني للحضارة الإنسانية."
  },
  {
    title: "كشف قصص الماضي",
    img: Img_2,
    des: "سواء كنت مسافرًا متمرسًا أو مستكشفًا على كرسي بذراعين،أثري يوفر لك رؤى قيمة ونصائح سفر لمساعدتك في التخطيط لمغامرتك القادمة. اكتشف الجواهر المخفية والكنوز الأقل شهرة والوجهات البعيدة عن الطرق التي ستثري رحلتك وتخلق ذكريات لا تُنسى."
  },
  {
    title: "خطط لمغامرتك القادمة",
    img: Img_3,
    des: "يحكي كل نصب تذكاري قصة تعكس معتقدات وتطلعات وإنجازات المجتمعات التي بنتها. انغمس في تاريخ هذه الكنوز الثقافية وأهميتها، واكتشف القصص الرائعة وراء بنائها والحفاظ عليها وأهميتها الثقافية."
  }
];
const CardData = [
  {
    title: "معبد ابوسبل",
    price: "150 ر.س",
    place: "الاقصر",
    img: Img,
    des: "  يعد معبد ابوسبل احد الاثار المصرية المميزة التي تتميز بجمالها ودقة تصميمها  "
  },
  {
    title: " الاهرامات المصرية",
    price: "180 ر.س",
    place: "الجيزة",
    img: Img,
    des: "  يعد  الاهرامات المصرية احد الاثار المصرية المميزة التي تتميز بجمالها ودقة تصميمها  "
  },
  {
    title: " برج بيزا المائل ",
    price: "1800 ر.س",
    place: "ايطاليا ميلان",
    img: Img,
    des: "  يعد  برج بيزا المائل  احد الاثار المصرية المميزة التي تتميز بجمالها ودقة تصميمها  "
  },
  {
    title: "معبد ابوسبل",
    price: "150 ر.س",
    place: "الاقصر",
    img: Img,
    des: "  يعد معبد ابوسبل احد الاثار المصرية المميزة التي تتميز بجمالها ودقة تصميمها  "
  },
  {
    title: " الاهرامات المصرية",
    price: "180 ر.س",
    place: "الجيزة",
    img: Img,
    des: "  يعد  الاهرامات المصرية احد الاثار المصرية المميزة التي تتميز بجمالها ودقة تصميمها  "
  },
  {
    title: " برج بيزا المائل ",
    price: "1800 ر.س",
    place: "ايطاليا ميلان",
    img: Img,
    des: "  يعد  برج بيزا المائل  احد الاثار المصرية المميزة التي تتميز بجمالها ودقة تصميمها  "
  }
];

const $$Astro$G = createAstro();
const $$LinkList = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$G, $$props, $$slots);
  Astro2.self = $$LinkList;
  return renderTemplate`${maybeRenderHead()}<ul class="d-flex items-center link-list normalMenu"> ${HeaderData.map((link) => renderTemplate`<li class="nav-items pr-12"> <a class="fw-700 nav-link  relative"${addAttribute(link.path, "href")}> ${" "} ${link.title}${" "} </a> </li>`)} </ul>`;
}, "D:/project/version/2/Astro/Asre/src/components/header/LinkList.astro", void 0);

const $$Astro$F = createAstro();
const $$Button = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$F, $$props, $$slots);
  Astro2.self = $$Button;
  const { ClassName, type, aria, id } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<button${addAttribute(`btn ${ClassName}`, "class:list")}${addAttribute(type, "type")}${addAttribute(aria, "aria-label")}${addAttribute(id, "id")}> ${renderSlot($$result, $$slots["default"])} </button>`;
}, "D:/project/version/2/Astro/Asre/src/components/ui/Button.astro", void 0);

const $$Astro$E = createAstro();
const $$Header = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$E, $$props, $$slots);
  Astro2.self = $$Header;
  return renderTemplate`${maybeRenderHead()}<header class="absolute top-0"> <div class="container"> <nav class="d-flex items-center justify-between py-2"> <a href="/" class="logo"> ${renderComponent($$result, "Image", $$Image, { "src": Logo, "alt": `logo for Gift Genius `, "format": "webp", "quality": 70, "class": `img-cover`, "loading": "eager" })} </a> ${renderComponent($$result, "Button", $$Button, { "type": "button", "ClassName": "icon-nav-base", "aria": "open menu" }, { "default": ($$result2) => renderTemplate` <span></span><span></span><span></span> ` })} ${renderComponent($$result, "LinkList", $$LinkList, {})} ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "Auth page", "ClassName": "btn-popup nav-button round-6" }, { "default": ($$result2) => renderTemplate` <a href="Auth.html" class="py-6 px-14 fw-700 fs-18">انضم الينا</a> ` })} </nav> </div> </header>`;
}, "D:/project/version/2/Astro/Asre/src/components/header/Header.astro", void 0);

const icons = {"local":{"prefix":"local","lastModified":1712601405,"icons":{"admin":{"body":"<path fill=\"currentColor\" d=\"M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75 6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76 4.76 4.76 0 0 0-4.76-4.76\" class=\"clr-i-outline clr-i-outline-path-1\"/><path fill=\"currentColor\" d=\"M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.81 14.81 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z\" class=\"clr-i-outline clr-i-outline-path-2\"/><path fill=\"currentColor\" d=\"M26.87 16.29a.37.37 0 0 1 .15 0 .42.42 0 0 0-.15 0\" class=\"clr-i-outline clr-i-outline-path-3\"/><path fill=\"currentColor\" d=\"m33.68 23.32-2-.61a7.21 7.21 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7.15 7.15 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.77 6.77 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7.09 7.09 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a6.92 6.92 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28\" class=\"clr-i-outline clr-i-outline-path-4\"/><path fill=\"none\" d=\"M0 0h36v36H0z\"/>","width":36,"height":36},"arrow-down":{"body":"<path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"m7 10 5 5 5-5\"/>"},"arrow-left":{"body":"<path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 6 2 16l8 10M2 16h28\"/>","width":32,"height":32},"client":{"body":"<path fill=\"currentColor\" d=\"M18 17a7 7 0 1 0-7-7 7 7 0 0 0 7 7m0-12a5 5 0 1 1-5 5 5 5 0 0 1 5-5\" class=\"clr-i-outline clr-i-outline-path-1\"/><path fill=\"currentColor\" d=\"M30.47 24.37a17.16 17.16 0 0 0-24.93 0A2 2 0 0 0 5 25.74V31a2 2 0 0 0 2 2h22a2 2 0 0 0 2-2v-5.26a2 2 0 0 0-.53-1.37M29 31H7v-5.27a15.17 15.17 0 0 1 22 0Z\" class=\"clr-i-outline clr-i-outline-path-2\"/><path fill=\"none\" d=\"M0 0h36v36H0z\"/>","width":36,"height":36},"close":{"body":"<path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18 18 6m0 12L6 6\"/>"},"guide":{"body":"<path fill=\"currentColor\" d=\"M13 8v8a3 3 0 0 1-3 3H7.83a3.001 3.001 0 1 1 0-2H10a1 1 0 0 0 1-1V8a3 3 0 0 1 3-3h3V2l5 4-5 4V7h-3a1 1 0 0 0-1 1M5 19a1 1 0 1 0 0-2 1 1 0 0 0 0 2\"/>"},"hotel":{"body":"<path fill=\"currentColor\" d=\"M0 32C0 14.3 14.3 0 32 0h448c17.7 0 32 14.3 32 32s-14.3 32-32 32v384c17.7 0 32 14.3 32 32s-14.3 32-32 32H304v-48c0-26.5-21.5-48-48-48s-48 21.5-48 48v48H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64C14.3 64 0 49.7 0 32m96 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16m144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16m-240 80c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16m144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-40 192c13.3 0 24.3-10.9 21-23.8-10.6-41.5-48.2-72.2-93-72.2s-82.5 30.7-93 72.2c-3.3 12.8 7.8 23.8 21 23.8z\"/>","width":512,"height":512},"location":{"body":"<path fill=\"currentColor\" d=\"M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7M7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 2.88-2.88 7.19-5 9.88C9.92 16.21 7 11.85 7 9\"/><circle cx=\"12\" cy=\"9\" r=\"2.5\" fill=\"currentColor\"/>"},"ticket":{"body":"<path fill=\"currentColor\" d=\"M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64h448c35.3 0 64-28.7 64-64v-64c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6v-64c0-35.3-28.7-64-64-64zm64 112v160c0 8.8 7.2 16 16 16h288c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16m-32-16c0-17.7 14.3-32 32-32h320c17.7 0 32 14.3 32 32v192c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32z\"/>","width":576,"height":512},"user":{"body":"<path fill=\"currentColor\" d=\"M15.71 12.71a6 6 0 1 0-7.42 0 10 10 0 0 0-6.22 8.18 1 1 0 0 0 2 .22 8 8 0 0 1 15.9 0 1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1 10 10 0 0 0-6.25-8.19M12 12a4 4 0 1 1 4-4 4 4 0 0 1-4 4\"/>"}},"width":24,"height":24}};

const cache = /* @__PURE__ */ new WeakMap();

const $$Astro$D = createAstro();
const $$Icon = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$D, $$props, $$slots);
  Astro2.self = $$Icon;
  class AstroIconError extends Error {
    constructor(message) {
      super(message);
    }
  }
  const req = Astro2.request;
  const { name = "", title, "is:inline": inline = false, ...props } = Astro2.props;
  const map = cache.get(req) ?? /* @__PURE__ */ new Map();
  const i = map.get(name) ?? 0;
  map.set(name, i + 1);
  cache.set(req, map);
  const includeSymbol = !inline && i === 0;
  let [setName, iconName] = name.split(":");
  if (!setName && iconName) {
    const err = new AstroIconError(`Invalid "name" provided!`);
    throw err;
  }
  if (!iconName) {
    iconName = setName;
    setName = "local";
    if (!icons[setName]) {
      const err = new AstroIconError('Unable to load the "local" icon set!');
      throw err;
    }
    if (!(iconName in icons[setName].icons)) {
      const err = new AstroIconError(`Unable to locate "${name}" icon!`);
      throw err;
    }
  }
  const collection = icons[setName];
  if (!collection) {
    const err = new AstroIconError(`Unable to locate the "${setName}" icon set!`);
    throw err;
  }
  const iconData = getIconData(collection, iconName ?? setName);
  if (!iconData) {
    const err = new AstroIconError(`Unable to locate "${name}" icon!`);
    throw err;
  }
  const id = `ai:${collection.prefix}:${iconName ?? setName}`;
  if (props.size) {
    props.width = props.size;
    props.height = props.size;
    delete props.size;
  }
  const renderData = iconToSVG(iconData);
  const normalizedProps = { ...renderData.attributes, ...props };
  const normalizedBody = renderData.body;
  return renderTemplate`${maybeRenderHead()}<svg${spreadAttributes(normalizedProps)}${addAttribute(name, "data-icon")}> ${title && renderTemplate`<title>${title}</title>`} ${inline ? renderTemplate`${renderComponent($$result, "Fragment", Fragment, { "id": id }, { "default": ($$result2) => renderTemplate`${unescapeHTML(normalizedBody)}` })}` : renderTemplate`${renderComponent($$result, "Fragment", Fragment, {}, { "default": ($$result2) => renderTemplate`${includeSymbol && renderTemplate`<symbol${addAttribute(id, "id")}>${unescapeHTML(normalizedBody)}</symbol>`}<use${addAttribute(`#${id}`, "xlink:href")}></use> ` })}`} </svg>`;
}, "D:/project/version/2/Astro/Asre/node_modules/astro-icon/components/Icon.astro", void 0);

const $$Astro$C = createAstro();
const $$Footer = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$C, $$props, $$slots);
  Astro2.self = $$Footer;
  return renderTemplate`${maybeRenderHead()}<footer> <div class="container d-flex items-start justify-between"> <div class="footer-ul about-us"> <p class="title fs-24 fw-700">من نحن</p> <p class="dec line-relaxed fs-16">
نحن نقدم لك احدث العروض السياحية التي تناسب  جميع الفئات بافضل
        الاسعار
</p> </div> <!--  --> <div class="footer-ul contact-us"> <p class="title fs-24 fw-700">تواصل معانا</p> <p class="dec line-relaxed fs-16">
تطبيق الويب المثالي لاستكشاف العالم من حولك ومعرفة الماضي  الخصاص بالحضارت المختلفة
</p> </div> <!--  --> <div class="footer-ul news"> <p class="title fs-24 fw-700">اخر الاحداث</p> <p class="dec line-relaxed fs-16">
يمكنك الوثوق بنا، فنحن نرسل العروض فقط، وليس بريدًا عشوائيًا واحدًا
</p> <form action="/"> <div class="from-group relative mt-7"> <input type="email" placeholder="البريد الالكتروني" class="round-4 pr-5"> ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "send email", "ClassName": " btn-popup sendEmails round-4 px-9  top-0 left-0" }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Icon", $$Icon, { "name": "arrow-left" })} ` })} </div> </form> </div> </div> </footer>`;
}, "D:/project/version/2/Astro/Asre/src/components/footer/Footer.astro", void 0);

const $$Astro$B = createAstro();
const $$Layout = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$B, $$props, $$slots);
  Astro2.self = $$Layout;
  const { title } = Astro2.props;
  return renderTemplate`<html lang="ar"> <head><meta charset="UTF-8"><meta name="description" content="Astro description"><meta name="viewport" content="width=device-width"><link rel="icon" type="image/svg+xml" href="favicon.svg"><meta name="generator"${addAttribute(Astro2.generator, "content")}><title>${title}</title><!-- <Font /> -->${renderHead()}</head> <body> ${renderComponent($$result, "Header", $$Header, {})} ${renderSlot($$result, $$slots["default"])} ${renderComponent($$result, "Footer", $$Footer, {})}  </body> </html>`;
}, "D:/project/version/2/Astro/Asre/src/layouts/Layout.astro", void 0);

const $$Astro$A = createAstro();
const $$MainHeading = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$A, $$props, $$slots);
  Astro2.self = $$MainHeading;
  const { title } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="mainHeading text-center"> <h2 class="fs-36 fw-700 d-inline-block relative">${title}</h2> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/ui/mainHeading.astro", void 0);

const $$Astro$z = createAstro();
const $$AboutSetion = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$z, $$props, $$slots);
  Astro2.self = $$AboutSetion;
  return renderTemplate`${maybeRenderHead()}<section class="most-wanted About"> ${renderComponent($$result, "MainHeading", $$MainHeading, { "title": " \u0627\u0639\u0631\u0641 \u0639\u0646\u0627 " })} <div class="container"> <div class="row"> <!-- right --> <div class="col-5-lg col-12-md col-6-sm"> <div class="aboutDetails pl-10"> <h3 class="fs-r-36 fw-800 line-relaxed mb-6">
نحن نقدم أفضل العروض السياحية في ميزانيتك
</h3> <p class="fs-18 line-normal">
في اثري مهمتنا بسيطة: اكتشاف كنوز الماضي ومشاركتها مع العالم. نحن
            نؤمن أنه من خلال استكشاف المواقع الأثرية والمعالم الثقافية، يمكن
            للمسافرين اكتساب فهم أعمق للتراث الجماعي للإنسانية وتعزيز تقدير أكبر
            للتنوع في عالمنا.
</p> </div> </div> <!-- left --> <div class="col-7-lg col-12-md col-6-sm"> <div class="img-container"> ${renderComponent($$result, "Image", $$Image, { "src": Img, "alt": `about us img`, "class": `round-6` })} </div> </div> <!-- end row --> </div> </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/home/AboutSetion.astro", void 0);

const $$Astro$y = createAstro();
const $$Breadcrumb = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$y, $$props, $$slots);
  Astro2.self = $$Breadcrumb;
  const { linkPage, defPage, path, isCrumb } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section class="breadcrumb d-flex items-center justify-center relative overflow-hidden"> <div class="img_Container absolute"></div> <div class="container"> <h1 class="title capitalize pb-5 text-center fs-r-36 fw-700 line-normal"> ${linkPage} ${isCrumb ? null : renderTemplate`<span id="userName"></span>`} </h1> ${!isCrumb && renderTemplate`<ul class="d-flex items-center justify-center relative"> <li class="linkPage">${linkPage}</li> <li class="separator"></li> <li class="defPage "> <a${addAttribute(path, "href")} class=""> ${defPage} </a> </li> </ul>`} </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/ui/breadcrumb.astro", void 0);

const $$Astro$x = createAstro();
const $$AboutUs = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$x, $$props, $$slots);
  Astro2.self = $$AboutUs;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre |  \u0645\u0646 \u0646\u062D\u0646 " }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u0645\u0646 \u0646\u062D\u0646 ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "AboutSection", $$AboutSetion, {})} </main> ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/AboutUs.astro", void 0);

const $$file$b = "D:/project/version/2/Astro/Asre/src/pages/AboutUs.astro";
const $$url$b = "/AboutUs.html";

const AboutUs = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$AboutUs,
  file: $$file$b,
  url: $$url$b
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$w = createAstro();
const $$FormGroup = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$w, $$props, $$slots);
  Astro2.self = $$FormGroup;
  const { title, name, type } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="formGroup relative mb-7"> <input${addAttribute(type, "type")}${addAttribute(name, "name")}${addAttribute(name, "id")} class="round-4 pr-5" required> <label${addAttribute(name, "for")} class="absolute top-50 right-5">${title}</label> <p class="error"></p> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/ui/FormGroup.astro", void 0);

const $$Astro$v = createAstro();
const $$LoginInForm = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$v, $$props, $$slots);
  Astro2.self = $$LoginInForm;
  return renderTemplate`${maybeRenderHead()}<div class="signIn Form" style="display: none;"> <form action=""> <h1 class="text-center fs-r-30 fw-800 mb-8 line-relaxed">تسجيل الدخول</h1> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "email", "name": "userEmailLogin", "title": "\u0627\u0644\u0628\u0631\u064A\u062F \u0627\u0644\u0627\u0644\u0643\u062A\u0631\u0648\u0646\u064A" })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "password", "name": "userPasswordLogin", "title": "\u0643\u0644\u0645\u0629 \u0627\u0644\u0645\u0631\u0648\u0631" })} ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "sign in", "ClassName": "mt-8 btn-popup px-10 py-5 round-6 fs-18 d-flex items-center justify-center mx-auto" }, { "default": ($$result2) => renderTemplate`
تسجيل الدخول
` })} <p class="text-center mt-6 fs-14 changeResponsive">
ليس لديك حساب؟ <span class="fw-800 signInBtn"> أنشئ حسابك</span> </p> </form> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/Auth/LoginInForm.astro", void 0);

const $$Astro$u = createAstro();
const $$SignUpForm = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$u, $$props, $$slots);
  Astro2.self = $$SignUpForm;
  return renderTemplate`${maybeRenderHead()}<div class="signUp Form pt-14"> <form action=""> <h1 class="text-center fs-r-30 fw-800 mb-6 line-relaxed">أنشئ حسابك</h1> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "text", "name": "userName", "title": "\u0627\u0644\u0627\u0633\u0645 \u0628\u0627\u0644\u0643\u0627\u0645\u0644" })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "email", "name": "userEmail", "title": "\u0627\u0644\u0628\u0631\u064A\u062F \u0627\u0644\u0627\u0644\u0643\u062A\u0631\u0648\u0646\u064A" })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "number", "name": "userPhone", "title": "\u0631\u0642\u0645 \u0627\u0644\u0647\u0627\u062A\u0641" })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "password", "name": "userPassword", "title": "\u0643\u0644\u0645\u0629 \u0627\u0644\u0645\u0631\u0648\u0631" })} ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "sign in", "ClassName": "mt-5 btn-popup px-10 py-5 round-6 fs-18 d-flex items-center justify-center mx-auto" }, { "default": ($$result2) => renderTemplate`
التسجيل
` })} <p class="text-center mt-6 fs-14 changeResponsive">
هل لديك حساب؟ <span class="fw-800 signUpBtn">تسجيل الدخول</span> </p> </form> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/Auth/SignUpForm.astro", void 0);

const $$Astro$t = createAstro();
const $$ToggleText = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$t, $$props, $$slots);
  Astro2.self = $$ToggleText;
  const { title, des, BtnName, ClassNames, id } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div${addAttribute(`togglePanel ${ClassNames} relative overflow-hidden`, "class")}> <h1 class="fs-r-36 fw-800 line-relaxed"> ${title} </h1> <p class="fw-500 line-relaxed py-6 px-14">${des}</p> ${renderComponent($$result, "Button", $$Button, { "type": "button", "ClassName": "mt-5 btn-popup px-10 py-5 round-6 fs-18 ", "aria": BtnName, "id": id }, { "default": ($$result2) => renderTemplate`${BtnName}` })} </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/Auth/ToggleText.astro", void 0);

const $$Astro$s = createAstro();
const $$AuthText = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$s, $$props, $$slots);
  Astro2.self = $$AuthText;
  return renderTemplate`${maybeRenderHead()}<div class="toggle absolute right-0"> ${renderComponent($$result, "ToggleText", $$ToggleText, { "title": `\u0627\u0646\u0636\u0645 \u0627\u0644\u064A\u0646\u0627`, "des": "\u0646\u062D\u0646 \u0646\u0642\u062F\u0645 \u0644\u0643 \u0627\u062D\u062F\u062B \u0645\u0646\u062A\u062C\u0627\u062A \u0627\u0644\u0647\u062F\u0627\u064A\u0627 \u0627\u0644\u062A\u064A \u062A\u062A\u0646\u0627\u0633\u0628 \u0645\u0639 \u062C\u0645\u064A\u0639 \u0627\u0644\u0645\u0646\u0627\u0633\u0628\u0627\u062A \u0628\u0627\u0641\u0636\u0644 \u0627\u0644\u0627\u0633\u0639\u0627\u0631", "BtnName": "\u062A\u0633\u062C\u064A\u0644 \u0627\u0644\u062F\u062E\u0648\u0644", "ClassNames": "toggleLeft active text-center", "id": "Login" })} <!-- right --> ${renderComponent($$result, "ToggleText", $$ToggleText, { "title": "\u0645\u0631\u062D\u0628\u0627 \u0628\u0639\u0648\u062F\u062A\u0643", "des": "\u0646\u062D\u0646 \u0646\u0642\u062F\u0645 \u0644\u0643 \u0627\u062D\u062F\u062B \u0645\u0646\u062A\u062C\u0627\u062A \u0627\u0644\u0647\u062F\u0627\u064A\u0627 \u0627\u0644\u062A\u064A \u062A\u062A\u0646\u0627\u0633\u0628 \u0645\u0639 \u062C\u0645\u064A\u0639 \u0627\u0644\u0645\u0646\u0627\u0633\u0628\u0627\u062A \u0628\u0627\u0641\u0636\u0644 \u0627\u0644\u0627\u0633\u0639\u0627\u0631", "BtnName": "\u0627\u0646\u0636\u0645 \u0627\u0644\u064A\u0646\u0627", "ClassNames": "toggleRight text-center", "id": "Register" })} </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/Auth/AuthText.astro", void 0);

const $$Astro$r = createAstro();
const $$SlideAuth = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$r, $$props, $$slots);
  Astro2.self = $$SlideAuth;
  return renderTemplate`${maybeRenderHead()}<div class="container d-flex items-start justify-center mt-14 AuthMain"> <section class="slideAuth relative mx-auto"> <div class="d-flex items-start overflow-hidden" id="container"> ${renderComponent($$result, "LoginInForm", $$LoginInForm, {})} ${renderComponent($$result, "SignUp", $$SignUpForm, {})} ${renderComponent($$result, "AuthText", $$AuthText, {})} </div> </section> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/Auth/SlideAuth.astro", void 0);

const bgImg = new Proxy({"src":"./assets/images/asre-cnAquRBy.png","width":1200,"height":800,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/Asre/src/assets/images/asre.png";
							}
							globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/Asre/src/assets/images/asre.png");
							return target[name];
						}
					});

const $$Astro$q = createAstro();
const $$AdminAuth = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$q, $$props, $$slots);
  Astro2.self = $$AdminAuth;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre  | register" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main class="relative Main"> <div class="imgContainer absolute"> ${renderComponent($$result2, "Image", $$Image, { "src": bgImg, "alt": `bg`, "class": `img-cover`, "loading": "eager" })} </div> ${renderComponent($$result2, "SlideAuth", $$SlideAuth, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/AdminAuth.astro", void 0);

const $$file$a = "D:/project/version/2/Astro/Asre/src/pages/AdminAuth.astro";
const $$url$a = "/AdminAuth.html";

const AdminAuth = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$AdminAuth,
  file: $$file$a,
  url: $$url$a
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$p = createAstro();
const $$ChooseAuth = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$p, $$props, $$slots);
  Astro2.self = $$ChooseAuth;
  return renderTemplate`${maybeRenderHead()}<div class="container d-flex items-start justify-center mt-14 AuthMain"> <section class="slideAuth relative mx-auto"> <div class="d-flex items-start overflow-hidden" id="container"> <section class="ChooseAuth d-flex items-center justify-center"> <!-- box for admin --> <div class="Box ml-14 relative text-center round-6"> ${renderComponent($$result, "Icon", $$Icon, { "name": "admin" })} <p class="fw-500 fs-18 pt-5">تسجيل كمشرف</p> <a href="AdminAuth.html" title="AdminAuth.html" class="absolute"></a> </div> <div class="Box relative text-center round-6"> ${renderComponent($$result, "Icon", $$Icon, { "name": "client" })} <p class="fw-500 fs-18 pt-5">تسجيل كمستخدم</p> <a href="ClientAuth.html" title="ClientAuth.html" class="absolute"></a> </div> </section> </div> </section> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/Auth/ChooseAuth.astro", void 0);

const $$Astro$o = createAstro();
const $$Auth = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$o, $$props, $$slots);
  Astro2.self = $$Auth;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre  | register" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main class="relative Main"> <div class="imgContainer absolute"> ${renderComponent($$result2, "Image", $$Image, { "src": bgImg, "alt": `bg`, "class": `img-cover`, "loading": "eager" })} </div> ${renderComponent($$result2, "ChooseAuth", $$ChooseAuth, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/Auth.astro", void 0);

const $$file$9 = "D:/project/version/2/Astro/Asre/src/pages/Auth.astro";
const $$url$9 = "/Auth.html";

const Auth = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Auth,
  file: $$file$9,
  url: $$url$9
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$n = createAstro();
const $$CartDetails = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$n, $$props, $$slots);
  Astro2.self = $$CartDetails;
  const { title, isSure, isAdmn } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section class="cart"> ${renderComponent($$result, "MainHeading", $$MainHeading, { "title": title })} <div class="container"> <table> <thead> <tr> ${isAdmn && renderTemplate`<td>اسم المستخدم</td>`} <td>اسم المرشد</td> <td>بداية الرحلة</td> <td>نهاية الرحلة</td> <td>عدد الافراد</td> <td>التكلفة</td> </tr> </thead> <tbody> <tr> ${isAdmn && renderTemplate`<td>محمد جمال</td>`} <td> احمد التطاوي</td> <td> 9-3-2024</td> <td>29-3-2024</td> <td> 10</td> <td> 1800 ر.س</td> ${isSure && renderTemplate`<td> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u062A\u0627\u0643\u064A\u062F \u0627\u0644\u062D\u062C\u0632", "ClassName": "btn-popup py-3 px-6 round-6 sure" }, { "default": ($$result2) => renderTemplate`
تاكيد
` })} </td>`} <td> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u0644\u063A\u0627\u0621 \u0627\u0644\u062D\u062C\u0632", "ClassName": "btn-popup py-3 px-6 round-6 delete" }, { "default": ($$result2) => renderTemplate`
الغاء
` })} </td> </tr> </tbody> </table> </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/cart/CartDetails.astro", void 0);

const $$Astro$m = createAstro();
const $$Cart = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$m, $$props, $$slots);
  Astro2.self = $$Cart;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u0645\u0639\u0627\u0644\u0645 \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": "  \u062C\u062F\u0648\u0644 \u0627\u0644\u0631\u062D\u0644\u0627\u062A  ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "CartDetails", $$CartDetails, { "title": "\u062A\u0627\u0643\u064A\u062F \u0627\u0644\u062D\u062C\u0632", "isSure": true, "isAdmn": false })} <!-- <CartDetails title=" حجوزات سابقة" isSure={false}/> --> </main> ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/cart.astro", void 0);

const $$file$8 = "D:/project/version/2/Astro/Asre/src/pages/cart.astro";
const $$url$8 = "/cart.html";

const cart = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Cart,
  file: $$file$8,
  url: $$url$8
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$l = createAstro();
const $$ClientAuth = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$l, $$props, $$slots);
  Astro2.self = $$ClientAuth;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre  | register" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main class="relative Main"> <div class="imgContainer absolute"> ${renderComponent($$result2, "Image", $$Image, { "src": bgImg, "alt": `bg`, "class": `img-cover`, "loading": "eager" })} </div> ${renderComponent($$result2, "SlideAuth", $$SlideAuth, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/ClientAuth.astro", void 0);

const $$file$7 = "D:/project/version/2/Astro/Asre/src/pages/ClientAuth.astro";
const $$url$7 = "/ClientAuth.html";

const ClientAuth = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$ClientAuth,
  file: $$file$7,
  url: $$url$7
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$k = createAstro();
const $$ControlBook = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$k, $$props, $$slots);
  Astro2.self = $$ControlBook;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u062D\u062C\u0648\u0632\u0627\u062A \u0627\u0644\u0639\u0645\u0644\u0627\u0621" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": "   \u062D\u062C\u0648\u0632\u0627\u062A \u0627\u0644\u0639\u0645\u0644\u0627\u0621  ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "CartDetails", $$CartDetails, { "title": " \u062D\u062C\u0648\u0632\u0627\u062A \u0627\u0644\u0639\u0645\u0644\u0627\u0621", "isSure": true, "isAdmn": true })} <!-- <CartDetails title=" حجوزات سابقة" isSure={false}/> --> </main> ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/ControlBook.astro", void 0);

const $$file$6 = "D:/project/version/2/Astro/Asre/src/pages/ControlBook.astro";
const $$url$6 = "/ControlBook.html";

const ControlBook = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$ControlBook,
  file: $$file$6,
  url: $$url$6
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$j = createAstro();
const $$Details = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$j, $$props, $$slots);
  Astro2.self = $$Details;
  return renderTemplate`${maybeRenderHead()}<section class="detailsSection"> <div class="container"> <div class="row"> <!-- right-side --> <div class="col-6-lg col-12-md col-12-sm row-right"> <div class="right-side"> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">اسم المعلم:</p> <p class="des name fs-24 fw-700">الاهرامات المصرية</p> </div> <div class="d-flex items-start mb-6"> <p class="title fs-18 fw-500">وصف:</p> <p class="des overview fs-18">
تم بناء الأهرامات على مدى عدة أجيال، امتدت من حوالي 2700 قبل
              الميلاد إلى 1700 قبل الميلاد. تم تشييدها باستخدام كتل ضخمة من
              الحجر الجيري، وتم استخراجها ونقلها إلى مواقع البناء بواسطة آلاف
              العمال. يتطلب بناء كل هرم تخطيطًا وتنظيمًا دقيقًا وموارد كبيرة.
</p> </div> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">مكان:</p> <p class="des fw-600 fs-20">الجيزة</p> </div> <div class="d-flex items-center justify-center mx-auto mt-14"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-popup  round-6" }, { "default": ($$result2) => renderTemplate` <a href="/" class="py-6 px-12 fs-18 fw-700"> احجز الان</a> ` })} </div> </div> </div> <!-- left-side --> <div class="col-6-lg col-12-md col-12-sm row-left"> <div class="left-side"> <div class="img-container round-6 relative"> ${renderComponent($$result, "Image", $$Image, { "src": Img, "alt": `\u0635\u0648\u0631\u0629 \u0627\u0644\u0645\u0639\u0644\u0645`, "quality": 70, "format": "webp", "class": `round-6` })} </div> </div> </div> <!-- end row --> </div> </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/details/details.astro", void 0);

const $$Astro$i = createAstro();
const $$DetailsTouristView = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$i, $$props, $$slots);
  Astro2.self = $$DetailsTouristView;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u0645\u0639\u0627\u0644\u0645 \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u0645\u0639\u0627\u0644\u0645 \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629 ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "Details", $$Details, {})} </main> ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/detailsTouristView.astro", void 0);

const $$file$5 = "D:/project/version/2/Astro/Asre/src/pages/detailsTouristView.astro";
const $$url$5 = "/detailsTouristView.php";

const detailsTouristView = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$DetailsTouristView,
  file: $$file$5,
  url: $$url$5
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$h = createAstro();
const $$Details2 = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$h, $$props, $$slots);
  Astro2.self = $$Details2;
  return renderTemplate`${maybeRenderHead()}<section class="detailsSection"> <div class="container"> <div class="row"> <!-- right-side --> <div class="col-5-lg col-12-md col-12-sm row-right"> <div class="right-side"> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">اسم المرشد:</p> <p class="des name fs-24 fw-700">احمد التطاوي</p> </div> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">بداية الجولة:</p> <p class="des fw-600 fs-20">14-3-2024</p> </div> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">نهاية الجولة:</p> <p class="des fw-600 fs-20">14-3-2024</p> </div> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">عدد الافراد:</p> <p class="des fw-600 fs-24">4</p> </div> <div class="d-flex items-center mb-6"> <p class="title fs-18 fw-500">التكلفة:</p> <p class="des price fs-24 fw-700">
1800
<span class="fs-16 fw-500">ر.س</span> </p> </div> <div class="mt-14"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-popup  round-6" }, { "default": ($$result2) => renderTemplate` <a href="cart.html" class="py-6 px-12 fs-18 fw-700"> احجز الان</a> ` })} </div> </div> </div> <!-- left-side --> <div class="col-7-lg col-12-md col-12-sm row-left"> <div class="left-side"> <div class="full-img-container round-6 relative d-flex items-center gap-y-5"> <div class=""> <a href="detailsTouristView.php"> ${renderComponent($$result, "Image", $$Image, { "src": Img, "alt": `\u0635\u0648\u0631\u0629 \u0627\u0644\u0645\u0639\u0644\u0645`, "quality": 70, "format": "webp", "class": `round-6 mb-5` })} </a> <a href="detailsTouristView.php"> ${renderComponent($$result, "Image", $$Image, { "src": Img, "alt": `\u0635\u0648\u0631\u0629 \u0627\u0644\u0645\u0639\u0644\u0645`, "quality": 70, "format": "webp", "class": `round-6` })} </a> </div> <div> <a href="detailsTouristView.php"> ${renderComponent($$result, "Image", $$Image, { "src": Img, "alt": `\u0635\u0648\u0631\u0629 \u0627\u0644\u0645\u0639\u0644\u0645`, "quality": 70, "format": "webp", "class": `round-6 mb-5` })} </a> <a href="detailsTouristView.php"> ${renderComponent($$result, "Image", $$Image, { "src": Img, "alt": `\u0635\u0648\u0631\u0629 \u0627\u0644\u0645\u0639\u0644\u0645`, "quality": 70, "format": "webp", "class": `round-6` })} </a> </div> </div> </div> </div> <!-- end row --> </div> </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/details/details2.astro", void 0);

const $$Astro$g = createAstro();
const $$DetailsViewTours = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$g, $$props, $$slots);
  Astro2.self = $$DetailsViewTours;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u062C\u0648\u0644\u0627\u062A \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u062C\u0648\u0644\u0627\u062A \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629 ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "Details", $$Details2, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/detailsViewTours.astro", void 0);

const $$file$4 = "D:/project/version/2/Astro/Asre/src/pages/detailsViewTours.astro";
const $$url$4 = "/detailsViewTours.html";

const detailsViewTours = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$DetailsViewTours,
  file: $$file$4,
  url: $$url$4
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$f = createAstro();
const $$PreviousBook = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$f, $$props, $$slots);
  Astro2.self = $$PreviousBook;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u062D\u062C\u0648\u0632\u0627\u062A  \u0633\u0627\u0628\u0642\u0629" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u062D\u062C\u0648\u0632\u0627\u062A \u0633\u0627\u0628\u0642\u0629", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "CartDetails", $$CartDetails, { "title": " \u062D\u062C\u0648\u0632\u0627\u062A \u0633\u0627\u0628\u0642\u0629", "isSure": false, "isAdmn": false })} </main> ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/PreviousBook.astro", void 0);

const $$file$3 = "D:/project/version/2/Astro/Asre/src/pages/PreviousBook.astro";
const $$url$3 = "/PreviousBook.html";

const PreviousBook = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$PreviousBook,
  file: $$file$3,
  url: $$url$3
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$e = createAstro();
const $$Filter = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$e, $$props, $$slots);
  Astro2.self = $$Filter;
  return renderTemplate`${maybeRenderHead()}<div class="filter-container d-flex items-center justify-between md-max-gap-x-5"> <h2 class="fs-r-30 fw-700">المعالم السياحية</h2> <div class="filter-input d-flex items-center md-max-gap-x-5"> <input type="text" placeholder="ادخل المدينة" name="" class="pr-5 round-6"> <input type="text" placeholder="ادخل اسم المَعلم" name="" class="pr-5 round-6 md-mr-4"> </div> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/TouristView/Filter.astro", void 0);

const $$Astro$d = createAstro();
const $$Card = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$d, $$props, $$slots);
  Astro2.self = $$Card;
  const { title, des, img, place, price, btnText, path, isBooking } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<a${addAttribute(path, "href")}> <div class="card round-8"> <div class="top"> ${renderComponent($$result, "Image", $$Image, { "src": img, "alt": `img for product`, "format": "webp", "quality": 70, "class": `img-cover` })} </div> <div class="body"> <div class="d-flex items-center justify-between pb-4"> <h3 class="fw-700 fs-28">${title}</h3> <p class="place d-flex items-center fw-700 "> ${renderComponent($$result, "Icon", $$Icon, { "name": "location", "size": 24, "class": `ml-1` })} ${place} </p> </div> <p class="des fs-18 pb-4 fw-500 line-normal">${des}</p> ${isBooking && renderTemplate`<p class="price des fs-18 pb-8 fw-500">
سعر الرحلة للفرد : <span>${price}</span> </p>`} ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-popup booking-btn mb-2 py-5 round-6 mx-auto d-flex items-center justify-center fs-18 fw-500" }, { "default": ($$result2) => renderTemplate`${btnText}` })} </div> <!-- end --> </div> </a>`;
}, "D:/project/version/2/Astro/Asre/src/components/Card.astro", void 0);

const $$Astro$c = createAstro();
const $$Row = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$c, $$props, $$slots);
  Astro2.self = $$Row;
  const { isBooking } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="row gap-row-1 gap-x-12"> ${CardData.map((card) => renderTemplate`<div class="col-4-lg col-6-md col-12-sm"> ${renderComponent($$result, "Card", $$Card, { "title": card.title, "img": card.img, "des": card.des, "place": card.place, "price": isBooking ? card.price : "", "btnText": isBooking ? "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646" : "\u0639\u0631\u0636 \u0627\u0644\u062A\u0641\u0627\u0635\u064A\u0644", "path": isBooking ? "detailsViewTours.html" : "detailsTouristView.php", "isBooking": isBooking })} </div>`)} </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/ui/Row.astro", void 0);

const $$Astro$b = createAstro();
const $$View = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$b, $$props, $$slots);
  Astro2.self = $$View;
  return renderTemplate`${maybeRenderHead()}<section class="tourist-view"> <div class="container"> <!-- filter --> ${renderComponent($$result, "Filter", $$Filter, {})} ${renderComponent($$result, "Row", $$Row, { "isBooking": false })} </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/TouristView/View.astro", void 0);

const $$Astro$a = createAstro();
const $$TouristView = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$a, $$props, $$slots);
  Astro2.self = $$TouristView;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u0639\u0631\u0636 \u0627\u0644\u0645\u0639\u0627\u0644\u0645 \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u0639\u0631\u0636 \u0627\u0644\u0645\u0639\u0627\u0644\u0645 \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629 ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "View", $$View, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/TouristView.astro", void 0);

const $$file$2 = "D:/project/version/2/Astro/Asre/src/pages/TouristView.astro";
const $$url$2 = "/TouristView.php";

const TouristView = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$TouristView,
  file: $$file$2,
  url: $$url$2
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$9 = createAstro();
const $$Top = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$9, $$props, $$slots);
  Astro2.self = $$Top;
  return renderTemplate`${maybeRenderHead()}<div class="top-tours d-flex items-center justify-between"> <h2 class="fs-r-30 fw-700">عرض الجولات السياحية</h2> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "open-search-model", "ClassName": "btn-popup search-btn py-6 px-12 round-6 fs-18 fw-700 ", "id": "openSearch" }, { "default": ($$result2) => renderTemplate`
ابحث عن جولاتك
` })} </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/ViewTours/Top.astro", void 0);

const $$Astro$8 = createAstro();
const $$ModelSearch = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$8, $$props, $$slots);
  Astro2.self = $$ModelSearch;
  return renderTemplate`${maybeRenderHead()}<div class="form-container"> <form action="" class="relative"> <h4 class="text-center fs-r-30 fw-700 pb-10">احجز جولتك</h4> <div class="date mb-12 d-flex items-center"> <p class="fs-18 fw-700">التاريخ</p> <div class="form-group relative d-flex items-center mr-8"> <label for="dateFrom">من</label> <input type="text" name="dateFrom" placeholder=" تارخ بداية الرحلة " class="mr-3 pr-5" id="dateFrom"> </div> <div class="form-group relative d-flex items-center mr-8"> <label for="dateFrom">الي</label> <input type="text" name="dateTo" placeholder=" تارخ نهاية الرحلة " class="mr-3 pr-5" id="dateTo"> </div> </div> <div class="userDetails mb-12 d-flex items-center"> <div class="form-group relative d-flex items-center mr-8"> <label for="numberUser" class="fs-18 fw-700">عدد الافراد</label> <div class="relative"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "more user", "ClassName": "absolute more" }, { "default": ($$result2) => renderTemplate`
+
` })} <input type="text" name="numberUser" placeholder=" عدد الافراد " class="mr-3" id="numberUser" value="1"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "mins user", "ClassName": "absolute mins" }, { "default": ($$result2) => renderTemplate`
-
` })} </div> </div> <!-- cost --> <div class="form-group relative d-flex items-center mr-8"> <label for="cost" class="pl-5 fs-18 fw-700"> التكلفة للفرد</label> <input type="text" name="cost" placeholder=" التكلفة للفرد " class="mr-3 pr-5" id="cost" value="180" disabled> <span class="pr-5">ر.س</span> </div> </div> <div class="form-group relative d-flex items-center mr-8 mb-12 city"> <label for="city" class="fs-18 fw-700"> المدينة</label> <input type="text" name="city" placeholder=" المدينة  " class="mr-3 pr-5" id="city"> </div> <div class="d-flex items-center justify-center mx-auto"> ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "searching", "ClassName": "btn-popup search-btn py-5 px-14 round-6 fs-18 fw-700" }, { "default": ($$result2) => renderTemplate`
بحث
` })} </div> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "close model", "ClassName": "btn-close py-6 px-6 absolute top-0 right-0", "id": "closeMode" }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Icon", $$Icon, { "name": `close` })} ` })} </form> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/ViewTours/ModelSearch.astro", void 0);

const $$Astro$7 = createAstro();
const $$Tours = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$7, $$props, $$slots);
  Astro2.self = $$Tours;
  return renderTemplate`${maybeRenderHead()}<section class="tours"> <div class="container"> ${renderComponent($$result, "Top", $$Top, {})} ${renderComponent($$result, "ModelSearch", $$ModelSearch, {})} ${renderComponent($$result, "Row", $$Row, { "isBooking": true })} </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/ViewTours/Tours.astro", void 0);

const $$Astro$6 = createAstro();
const $$ViewTours = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$6, $$props, $$slots);
  Astro2.self = $$ViewTours;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u0639\u0631\u0636 \u0627\u0644\u062C\u0648\u0644\u0627\u062A \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629" }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> <!-- bread cumb --> ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u0639\u0631\u0636 \u0627\u0644\u062C\u0648\u0644\u0627\u062A \u0627\u0644\u0633\u064A\u0627\u062D\u064A\u0629 ", "defPage": "\u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/", "isCrumb": false })} ${renderComponent($$result2, "Tours", $$Tours, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/ViewTours.astro", void 0);

const $$file$1 = "D:/project/version/2/Astro/Asre/src/pages/ViewTours.astro";
const $$url$1 = "/ViewTours.html";

const ViewTours = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$ViewTours,
  file: $$file$1,
  url: $$url$1
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$5 = createAstro();
const $$BoxSwiper = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$5, $$props, $$slots);
  Astro2.self = $$BoxSwiper;
  const { img, title, des } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="swiper-box"> <div class="imgContainer relative"> ${renderComponent($$result, "Image", $$Image, { "src": img, "alt": `img for ${title} `, "format": "webp", "quality": 70, "class": `img-cover` })} </div> <div class="details absolute"> <h1 class="fs-r-60 fw-700 pb-5">${title}</h1> <p class="fs-24 fw-500 des line-relaxed">${des}</p> </div> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/home/boxSwiper.astro", void 0);

const $$Astro$4 = createAstro();
const $$Swiper = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$4, $$props, $$slots);
  Astro2.self = $$Swiper;
  return renderTemplate`<!-- Slider main container -->${maybeRenderHead()}<div class="swiper hero-swiper" dir="rtl"> <!-- Additional required wrapper --> <div class="swiper-wrapper"> <!-- Slides --> ${SwiperData.map((slide) => renderTemplate`<div class="swiper-slide"> ${renderComponent($$result, "BoxSwiper", $$BoxSwiper, { "img": slide.img, "title": slide.title, "des": slide.des })} </div>`)} </div> <!-- If we need navigation buttons --> <div class="swiper-button-next"></div> <div class="swiper-button-prev"></div> </div>`;
}, "D:/project/version/2/Astro/Asre/src/components/home/swiper.astro", void 0);

const $$Astro$3 = createAstro();
const $$Hero = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$3, $$props, $$slots);
  Astro2.self = $$Hero;
  return renderTemplate`${maybeRenderHead()}<section class="hero relative"> ${renderComponent($$result, "Swiper", $$Swiper, {})} </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/home/Hero.astro", void 0);

const $$Astro$2 = createAstro();
const $$MostWanted = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$2, $$props, $$slots);
  Astro2.self = $$MostWanted;
  return renderTemplate`${maybeRenderHead()}<section class="most-wanted"> ${renderComponent($$result, "MainHeading", $$MainHeading, { "title": "\u0627\u0644\u0627\u0643\u062B\u0631 \u0637\u0644\u0628\u0627" })} <div class="container"> ${renderComponent($$result, "Row", $$Row, { "isBooking": false })} </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/home/MostWanted.astro", void 0);

const $$Astro$1 = createAstro();
const $$Servies = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$1, $$props, $$slots);
  Astro2.self = $$Servies;
  return renderTemplate`${maybeRenderHead()}<section class="most-wanted servies"> ${renderComponent($$result, "MainHeading", $$MainHeading, { "title": "\u062E\u062F\u0645\u0627\u062A\u0646\u0627 " })} <div class="container"> <div class="row gap-row-1"> <div class="col-4-lg col-6-md col-12-sm"> <div class="box-ser text-center mt-5 px-7 py-10 round-6"> ${renderComponent($$result, "Icon", $$Icon, { "name": "guide", "class": `mx-auto mb-7  ` })} <h3 class="fs-28 mb-6">دليل السفر</h3> <p>
إنه فقط أنه سيكون لديهم الكثير من الوقت. الكثير من العمل هو الكثير
            من العمل
</p> </div> </div> <div class="col-4-lg col-6-md col-12-sm"> <div class="box-ser text-center mt-5 px-7 py-10 round-6"> ${renderComponent($$result, "Icon", $$Icon, { "name": "hotel", "class": `mx-auto mb-7 ` })} <h3 class="fs-28 mb-6">دليل السفر</h3> <p>
إنه فقط أنه سيكون لديهم الكثير من الوقت. الكثير من العمل هو الكثير
            من العمل
</p> </div> </div> <div class="col-4-lg col-6-md col-12-sm"> <div class="box-ser text-center mt-5 px-7 py-10 round-6"> ${renderComponent($$result, "Icon", $$Icon, { "name": "ticket", "class": `mx-auto mb-7 ` })} <h3 class="fs-28 mb-6">دليل السفر</h3> <p>
إنه فقط أنه سيكون لديهم الكثير من الوقت. الكثير من العمل هو الكثير
            من العمل
</p> </div> </div> </div> </div> </section>`;
}, "D:/project/version/2/Astro/Asre/src/components/home/Servies.astro", void 0);

const $$Astro = createAstro();
const $$Index = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro, $$props, $$slots);
  Astro2.self = $$Index;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Asre | \u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629 " }, { "default": ($$result2) => renderTemplate` ${maybeRenderHead()}<main> ${renderComponent($$result2, "Hero", $$Hero, {})} ${renderComponent($$result2, "AboutSection", $$AboutSetion, {})} ${renderComponent($$result2, "MostWanted", $$MostWanted, {})} ${renderComponent($$result2, "Servies", $$Servies, {})} </main>  ` })}`;
}, "D:/project/version/2/Astro/Asre/src/pages/index.astro", void 0);

const $$file = "D:/project/version/2/Astro/Asre/src/pages/index.astro";
const $$url = "";

const index = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Index,
  file: $$file,
  url: $$url
}, Symbol.toStringTag, { value: 'Module' }));

export { AboutUs as A, ClientAuth as C, PreviousBook as P, TouristView as T, ViewTours as V, AdminAuth as a, Auth as b, cart as c, ControlBook as d, detailsTouristView as e, detailsViewTours as f, index as i };
