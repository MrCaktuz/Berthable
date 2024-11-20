import React from "react";
import { useTranslations } from "next-intl";
import BrandIcon from "@/components/icons/Brand";
import pageStyles from "@/styles/page.module.css";
import Link from "next/link";

export default function Home() {
  const t = useTranslations("Global");

  return (
    <div
      className={`${pageStyles.homePage} grid grid-rows-[20px_1fr_20px] items-center justify-items-center min-h-screen p-8 pb-20 gap-16 sm:p-20 font-[family-name:var(--font-geist-sans)]`}
    >
      <main className="flex flex-col gap-8 row-start-2 items-center sm:items-start">
        <div className="flex items-center justify-center">
          <BrandIcon className="me-10" />
          <h1 className="text-9xl font-serif">{t("brandName")}</h1>
        </div>
        <div className="w-full">
          <div className="p-4 border border-slate-300 my-3 flex justify-start gap-5 items-start">
            <h2 className="font-bold text-2xl">{t("titleOne")}</h2>
            <div>RecipeDescription</div>
          </div>
          <div className="p-4 border border-slate-300 my-3 flex justify-start gap-5 items-start">
            <h2 className="font-bold text-2xl">RecipeTitle</h2>
            <div>RecipeDescription</div>
          </div>
          <div className="p-4 border border-slate-300 my-3 flex justify-start gap-5 items-start">
            <h2 className="font-bold text-2xl">RecipeTitle</h2>
            <div>RecipeDescription</div>
          </div>
        </div>
        <Link href={"/recipes"}> Voir toutes</Link>
      </main>
      {/* <!-- TODO FOOTER --> */}
    </div>
  );
}
