import { NextResponse } from "next/server";

import Recipe from "@/models/Recipe";
import connectDB from "@/lib/mongoose";

export async function GET() {
  await connectDB();
  const lastRecipes = await Recipe.find().sort({ updatedAt: -1 }).limit(3);
  return NextResponse.json({ lastRecipes });
}
