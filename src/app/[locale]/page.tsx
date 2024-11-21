"use client";
import React, { useEffect, useState } from "react";
import { useTranslations } from "next-intl";
import BrandIcon from "@/components/icons/Brand";
import pageStyles from "@/styles/page.module.css";
import Link from "next/link";
import { API_URL } from "@/lib/utils";
import { Recipe } from "@/lib/types";

const getRecipes = async () => {
  try {
    const res = await fetch(`${API_URL}/homePage`, { cache: "no-store" });

    if (!res.ok) {
      throw new Error("Failed to fetch recipes");
    }

    return res.json();
  } catch (error) {
    console.error(`Error while fetching recipes : ${error}`);
  }
};

export default function Home() {
  const [recipes, setRecipes] = useState([]);
  const trad = useTranslations("Global");

  useEffect(() => {
    async function fetchData() {
      const { lastRecipes } = await getRecipes();
      setRecipes(lastRecipes);
    }
    fetchData();
  }, []);

  return (
    <div
      className={`${pageStyles.homePage} grid grid-rows-[20px_1fr_20px] items-center justify-items-center min-h-screen p-8 pb-20 gap-16 sm:p-20 font-[family-name:var(--font-geist-sans)]`}
    >
      <main className="max-w-full flex flex-col gap-8 row-start-2 items-center sm:items-start">
        <div className="flex items-center justify-center">
          <BrandIcon className="me-10" />
          <h1 className="text-9xl font-serif">{trad("brandName")}</h1>
        </div>
        <div className="w-full flex gap-3">
          {recipes.map((recipe: Recipe) => (
            <div
              key={recipe._id}
              className="p-4 border border-slate-300 my-3 flex justify-start gap-5 items-start w-1/3"
            >
              <h2 className="font-bold text-2xl">{recipe?.title}</h2>
              <div>{recipe?.description}</div>
            </div>
          ))}
        </div>
        <Link className="btn" href={"/recipes"}>
          Voir toutes
        </Link>
      </main>
      {/* <!-- TODO FOOTER --> */}
    </div>
  );
}
